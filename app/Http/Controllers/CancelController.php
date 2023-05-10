<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cancel;
use App\Models\Service;
use Twilio\Rest\Client;
use Exception;

class CancelController extends Controller
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $cancel = Cancel::create([
            'service_id' => $id,
            'why' => $request->why,
        ]);

        $service = Service::find($id);
        $service->service_status = 'cancelled';
        $service->service_date = null;
        $service->service_time = null;
        $service->save();

        $receiver_number = "+639474805411";
        $message = "Your booked service with ID: " . $service->id . "has been updated to " . $service->service_status . " status because of " . $cancel->why . ".";

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

        $discountAmount = 0;
        $transaction = $service->transaction;
        $vouchers = $transaction->vouchers;

        foreach ($vouchers as $voucher) {
            $discountAmount += $voucher->discount;

            $voucher->usage_count++;
            $voucher->save();
        }

        $transaction->transaction_date = null;
        $transaction->transaction_status = 'cancelled';
        $transaction->amount += $discountAmount;
        $transaction->save();
        $transaction->vouchers()->detach();

        return response()->json([
            'message' => 'Cancel service successfully!',
            'cancel' => $cancel,
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
        return response(Cancel::where('id', $id)->with(['service'])->first(), 200);
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
        //
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
