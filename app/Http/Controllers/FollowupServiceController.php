<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FollowupService;
use App\Models\Service;
use App\Models\Warranty;
use App\Mail\FollowupServiceCreatedNotification;
use App\Mail\AdminFollowupServiceCreatedNotification;
use App\Mail\FollowupServiceScheduleNotification;
use App\Mail\AdminFollowupServiceScheduleNotification;
use Carbon\Carbon;
use Twilio\Rest\Client;
use Exception;
use Mail;
use Validator;

class FollowupServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), 
        [
            'service_id' => 'required|integer',
            'reason' => 'required|string',
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(), 400);
        }

        $service = Service::find($request->service_id);
        $service->service_status = 'followup';
        $service->save();

        $followup_service = FollowupService::create([
            'service_id' => $request->service_id,
            'admin_id' => $service->admin_id,
            'reason' => $request->reason,
        ]);

        $technician_ids = $service->technicians()->pluck('technician_id')->toArray();
        $followup_service->technicians()->sync($technician_ids);

        $customer = $followup_service->service->customer->user;

        Mail::to($customer->email)->send(new FollowupServiceCreatedNotification($followup_service));

        $admin = $followup_service->service->admin->user;

        $technician_emails = $followup_service->technicians()
            ->wherePivot('followup_service_id', $followup_service->id)
            ->with('user')
            ->get()
            ->pluck('user.email')
            ->toArray();

        Mail::to($admin->email)->cc($technician_emails)->send(new AdminFollowupServiceCreatedNotification($followup_service));

        $receiver_number = "+639474805411";
        $message = "Your follow-up booked service has been successfully created with follow-up ID: " . $followup_service->id . ". The admin will now reschedule it.";

        try 
        {
            $account_sid = "ACbd8ad425b4cc31720acfa86b8a74e6b6";
            $auth_token = "5c11a160e29217298a09604094d9ebfc";
            $twilio_number = "+16204079792";

            $client = new Client($account_sid, $auth_token);
            $client->messages->create($receiver_number, [
                'from' => $twilio_number, 
                'body' => $message
            ]);
        } 
        catch (Exception $e) 
        {
            dd("Error: ". $e->getMessage());
        }
        
        return response()->json([
            'message' => 'Followup service successfully!',
            'followup_service' => $followup_service,
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response(FollowupService::where('id', $id)->with(['service'])->first(), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $followup_service = FollowupService::find($id);

        if ($request->has('followup_date') && $request->has('followup_time')) 
        {
            $service_table = Service::all();
            foreach ($service_table as $service) {
                if ($request->followup_date == $service->service_date && $request->followup_time == $service->service_time) 
                {
                    return response()->json([
                        'message' => 'Schedule is not available because it is already filled up!',
                    ], 400);
                }
            }

            $followup_table = FollowupService::all();
            foreach ($followup_table as $followup) {
                if ($followup->id != $id && $request->followup_date == $followup->followup_date && $request->followup_time == $followup->followup_time) 
                {
                    return response()->json([
                        'message' => 'Schedule is not available because it is already filled up!',
                    ], 400);
                }
            }
        }

        $validator = Validator::make($request->all(), 
        [
            'followup_report.*' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(), 400);
        }

        if ($request->hasFile('followup_report')) {
            $followup_report = $request->file('followup_report')->getClientOriginalName();
            $filename = uniqid() . '_' . $followup_report;
            $request->file('followup_report')->storeAs('public/images', $filename);
            $followup_service->followup_report = 'storage/images/'.$filename;
            $followup_service->followup_status = 'finished';
        }   

        $followup_service->update($request->except('followup_report'));

        if ($request->has('followup_date') && $request->has('followup_time')) 
        {
            $customer = $followup_service->service->customer->user;

            Mail::to($customer->email)->send(new FollowupServiceScheduleNotification($followup_service));

            $admin = $followup_service->service->admin->user;

            $technician_emails = $followup_service->technicians()
                ->wherePivot('followup_service_id', $followup_service->id)
                ->with('user')
                ->get()
                ->pluck('user.email')
                ->toArray();

            Mail::to($admin->email)->cc($technician_emails)->send(new AdminFollowupServiceScheduleNotification($followup_service));

            $receiver_number = "+639474805411";
            $message = "Your follow-up booked service with ID: " . $followup_service->id . " has been set in other schedule.";
        
            try {
                $account_sid = "ACbd8ad425b4cc31720acfa86b8a74e6b6";
                $auth_token = "5c11a160e29217298a09604094d9ebfc";
                $twilio_number = "+16204079792";
        
                $client = new Client($account_sid, $auth_token);
        
                $client->messages->create($receiver_number, [
                    'from' => $twilio_number, 
                    'body' => $message
                ]);
            } catch (Exception $e) {
                dd("Error: ". $e->getMessage());
            }
        }

        $today_date = Carbon::today();
        $period = 7;
        $warranty_date = $today_date->copy()->addDays($period);

        $service = Service::find($followup_service->service_id);

        if ($followup_service->followup_status === 'completed') {
            $warranty = new Warranty([
                'service_id' => $service->id,
                'warranty_type' => $service->service_type,
                'period' => $period,
                'start_date' => $today_date->format('Y-m-d'),
                'end_date' => $warranty_date->format('Y-m-d'),
            ]);
            $warranty->save();
        }

        if ($followup_service->followup_status === 'finished' || $followup_service->followup_status === 'completed') 
        {
            $receiver_number = "+639474805411";
            $message = "Your follow-up booked service with ID: " . $followup_service->id . " has been updated to " . $followup_service->followup_status . " status.";
        
            try {
                $account_sid = "ACbd8ad425b4cc31720acfa86b8a74e6b6";
                $auth_token = "5c11a160e29217298a09604094d9ebfc";
                $twilio_number = "+16204079792";
        
                $client = new Client($account_sid, $auth_token);
        
                $client->messages->create($receiver_number, [
                    'from' => $twilio_number, 
                    'body' => $message
                ]);
            } catch (Exception $e) {
                dd("Error: ". $e->getMessage());
            }
        }
        
        return response()->json([
            'message' => 'Followup service updated successfully!',
            'followup_service' => $followup_service,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
