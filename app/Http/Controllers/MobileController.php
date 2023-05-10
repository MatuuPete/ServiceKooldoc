<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Admin;
use App\Models\Cancel;
use App\Models\Customer;
use App\Models\Feedback;
use App\Models\FollowupService;
use App\Models\Service;
use App\Models\Technician;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Voucher;
use App\Mail\ServiceCreatedNotification;
use App\Mail\AdminServiceCreatedNotification;
use Twilio\Rest\Client;
use Auth;
use Carbon\Carbon;
use DB;
use Exception;
Use Hash;
use Mail;
use Validator;
use Log;
use Str;

class MobileController extends Controller
{
    public function mobileRegister(Request $request)
    {
        $validator = Validator::make($request->all(), 
        [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => [
                'required',
                'email',
                'ends_with:@gmail.com',
                Rule::unique('users')->where(function ($query) use ($request) {
                    return $query->where('email', $request->email);
                }),
            ],
            'password' => 'required|string|confirmed',
            'phone_number' => [
                'required',
                'regex:/(09)[0-9]{9}/',
                Rule::unique('users')->where(function ($query) use ($request) {
                    return $query->where('phone_number', $request->phone_number);
                }),
            ],
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(), 400);
        }

        $user = User::create([
            'full_name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
        ]);

        $customer = Customer::create([
            'user_id' => $user->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'address' => $request->address,
            'barangay' => $request->barangay,
            'city' => $request->city,
            'province' => $request->province,
            'zip_code' => $request->zip_code,
            'property_type' => $request->property_type, 
        ]);

        return response()->json([
            'message' => 'Customer created and registered successfully!',
            'user' => $user,
            'customer' => $customer,
        ], 201);
    }

    public function mobileLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) 
        {
            $user = Auth::user();

            if($user->role == 'technician') {
                $data = DB::table('users')
                        ->select('email', 'phone_number', 'role', 'technicians.id', 'technicians.user_id', 'technicians.image')
                        ->leftJoin('technicians', 'users.id', '=', 'technicians.user_id')
                        ->where('users.id', '=', $user->id)
                        ->first();

                return response()->json(['user_data' => $data], 200);
            } else if ($user->role == 'customer') {
                $data = DB::table('users')
                        ->select('email', 'phone_number', 'role', 'customers.id','customers.user_id','customers.image')
                        ->leftJoin('customers', 'users.id', '=', 'customers.user_id')
                        ->where('users.id', '=', $user->id)
                        ->first();
                
                return response()->json(['user_data' => $data], 200);
            }
        } 

        return response()->json(['error' => 'Invalid login credentials'], 401);
    }

    public function mobileLogout()
    {
        Auth::logout();
    }

    public function customerProfile($id)
    {
        $customer = Customer::find($id);

        $customer_data = DB::table('customers')
        ->select('customers.id','full_name','email','phone_number','address','barangay', 'city', 'province', 'zip_code', 'property_type','image',)
        ->leftJoin('users', 'customers.user_id', '=', 'users.id')
        ->where('customers.id', '=', $customer->id)
        ->first();

        return response()->json(['customer_data' => $customer_data],200);
    }

    public function technicianProfile($id)
    {
        $technician = Technician::find($id);
        $technician_data = DB::table('technicians')
        ->select('technicians.id','full_name','email','phone_number','age','experience','specialties','image')
        ->leftJoin('users', 'technicians.user_id', '=', 'users.id')
        ->where('technicians.id', '=', $technician->id)
        ->first();

        return response()->json(['technician_data' => $technician_data], 200);
    }
    
    public function customerChangePassword(Request $request, $id)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|confirmed',
        ]);

        $customer = Customer::find($id);
        $user = User::find($customer->user_id);

        if (!Hash::check($request->input('current_password'), $user->password)) {
            return response()->json(['message' => 'The provided current password is incorrect.'], 422);
        }

        $user->password = Hash::make($request->input('password'));
        $user->save();

        return response()->json(['message' => 'Password updated successfully.']);
    }

    public function technicianChangePassword(Request $request, $id)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|confirmed',
        ]);

        $technician = Technician::find($id);
        $user = User::find($technician->user_id);

        if (!Hash::check($request->input('current_password'), $user->password)) {
            return response()->json(['message' => 'The provided current password is incorrect.'], 422);
        }

        $user->password = Hash::make($request->input('password'));
        $user->save();

        return response()->json(['message' => 'Password updated successfully.']);
    }

    public function customerUpdate(Request $request, $id)
    {
        $customer = Customer::find($id);
        $user = User::find($customer->user_id);

       
        $user->update([
            'phone_number' => $request->input('phone_number'),
            'full_name' => $request->input('first_name') . ' ' . $request->input('last_name'),
        ]);
        
        $customer->update([
            'address' => $request->input('address'),
            'barangay' => $request->input('barangay'),
            'city' => $request->input('city'),
            'province' => $request->input('province'),
            'zip_code' => $request->input('zip_code'),
            'property_type' => $request->input('property_type'),
        ]);

        return response()->json([
            'message' => 'Customer updated successfully!',
            'customer' => $customer,
        ], 200);
    }

    public function technicianUpdate(Request $request, $id)
    {
        $technician = Technician::find($id);
        $user = User::find($technician->user_id);

        $validator = Validator::make($request->all(), 
        [
            'phone_number' => 'required|regex:/(09)[0-9]{9}/',
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(), 400);
        }

        $user->update([
            'phone_number' => $request->input('phone_number'),
            'full_name' => $request->input('first_name') . ' ' . $request->input('last_name'),
        ]);
            
        $technician->update([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'age' => $request->input('age'),
            'experience' => $request->input('experience'),
            'specialties' => $request->input('specialties'),
        ]);

        return response()->json([
            'message' => 'Technician updated successfully!',
            'technician' => $technician,
        ], 200);
    }

    public function customerImage(Request $request, $id)
    {
        $customer = Customer::find($id);

        $image = 'public/storage/images/'.time().'.jpg';
        file_put_contents($image,base64_decode($request->image));
        $customer->image = $image;
        $customer->save();

        return response()->json([
            'message' => 'Customer updated successfully!'
        ], 200);
    }

    public function technicianImage(Request $request, $id)
    {
        $technician = Technician::find($id);
        
        $image = 'public/storage/images/'.time().'.jpg';
        file_put_contents($image,base64_decode($request->image));
        $technician->image = $image;
        $technician->save();

        return response()->json([
            'message' => 'Customer updated successfully!'
        ], 200);
    }

    public function mobileBook(Request $request)
    {
        $customer_id = $request->customer_id;

        $customer = Customer::find($customer_id);

        if (!$customer->address || !$customer->barangay || !$customer->city || !$customer->province || !$customer->zip_code || !$customer->property_type)
        {
            return response()->json(['message' => 'Please fill up the necessary customer information!'], 400);
        }

        $service = new Service;
        $transaction = new Transaction();

        $validator = Validator::make($request->all(), 
        [
            'service_type' => 'required|string',
            'ac_type' => 'required|string',
            'ac_brand' => 'required|string',
            'ac_hp' => 'nullable|string',
            'unit_type' => 'required|string',
            'no_unit' => 'required|integer|min:1|max:10',
            'description' => 'nullable|string',
            'image.*' => 'nullable|image|mimes:jpeg,png,jpg',
            'cooling' => 'nullable|string',
            'mechanical_noise' => 'nullable|string',
            'electric_connectivity' => 'nullable|string',
            'service_date' => 'required|date',
            'service_time' => 'required|string',
            'service_price' => 'required|numeric',
            'service_report.*' => 'nullable|image|mimes:jpeg,png,jpg',
            'payment_method' => 'required|string',
            'amount' => 'required|numeric',
            'payment_proof' => 'nullable|image|mimes:jpeg,png,jpg',
            'notes' => 'nullable|string',
            'transaction_date' => 'nullable|date',
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(), 400);
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/images', $image);
            $service->image = 'storage/images/'.$image;
        }   
        else 
        {
            $service->image = null;
        }

        if ($request->hasFile('payment_proof')) 
        {
            $payment_proof = $request->file('payment_proof')->getClientOriginalName();
            $request->file('payment_proof')->storeAs('public/images', $payment_proof);
            $transaction->payment_proof = 'storage/images/'.$payment_proof;
            $transaction->transaction_date = $transaction->transaction_date ?? date('Y-m-d');
            $transaction->transaction_status = 'processing';
        } 
        else 
        {
            $transaction->payment_proof = null;
        }
        
        $service->customer_id = $customer_id;

        $service->fill($request->only(['book_type', 'service_type', 'ac_type', 'ac_brand', 'ac_hp', 'unit_type', 'no_unit', 'description', 'cooling', 'mechanical_noise', 'electric_connectivity', 'service_date', 'service_time', 'service_price']));

        $available_admins = Admin::whereDoesntHave('services', function ($query) use ($request) 
        {
            $query->where(function ($query) use ($request) 
            {
                $query->where('service_date', $request->service_date)
                    ->where('service_time', $request->service_time);
            });
        })->get();

        if ($available_admins->isEmpty()) 
        {
            $random_admin = Admin::inRandomOrder()->first();
            $service->admin_id = $random_admin->id;
        } 
        else 
        {
            $random_admin = $available_admins->random();
            $service->admin_id = $random_admin->id;
        }
        
        $technician_ids = $request->input('technician_ids', []);

        if (empty($technician_ids)) 
        {
            $available_technicians = Technician::whereDoesntHave('services', function ($query) use ($service) {
                $query->where('service_date', $service->service_date)
                    ->where('service_time', $service->service_time);
            })->where(function($query) use ($technician_ids) {
                $query->whereIn('id', $technician_ids)
                    ->orWhereNotIn('id', $technician_ids);
            })
            ->inRandomOrder()
            ->limit(3 - count($technician_ids))
            ->pluck('id')
            ->toArray();

            if (empty($available_technicians)) 
            {
                return response()->json(['message' => 'No technicians are available for the selected date and time.'], 400);
            } 
            elseif (count($available_technicians) < 2 || count($available_technicians) > 3) 
            {
                return response()->json(['message' => 'The number of available technicians is not within the required range.'], 400);
            }
            
            $technician_ids = array_merge($technician_ids, $available_technicians);
        } 
        else 
        {
            if (count($technician_ids) == 3) 
            {
                $technician_ids = array_unique($technician_ids);

                $conflicting_technicians = Technician::whereIn('id', $technician_ids)
                ->whereHas('services', function ($query) use ($service) {
                    $query->where('service_date', $service->service_date)
                        ->where('service_time', $service->service_time);
                })->pluck('id')->toArray();

                if (!empty($conflicting_technicians)) 
                {
                    return response()->json(['message' => 'One or more selected technicians have a conflicting service at the selected date and time.'], 400);
                }
            } 
            else 
            {
                if (count($technician_ids) == 1) {
                    $technician_schedule = Technician::where('id', $technician_ids[0])
                        ->whereHas('services', function ($query) use ($service) {
                            $query->where('service_date', $service->service_date)
                                ->where('service_time', $service->service_time);
                        })->first();
                
                    if ($technician_schedule) {
                        return response()->json(['message' => 'The selected technician is not available for the selected date and time. Please select another technician.'], 400);
                    }
                }
                elseif (count($technician_ids) == 2) {
                    $technician_schedules = Technician::whereIn('id', $technician_ids)
                        ->whereHas('services', function ($query) use ($service) {
                            $query->where('service_date', $service->service_date)
                                ->where('service_time', $service->service_time);
                        })->get();
                
                    if ($technician_schedules->count() > 0) {
                        return response()->json(['message' => 'One or more of the selected technicians are not available for the selected date and time. Please select another technician.'], 400);
                    }
                }

                $available_technicians = Technician::whereDoesntHave('services', function ($query) use ($service) {
                    $query->where('service_date', $service->service_date)
                        ->where('service_time', $service->service_time);
                })->where(function($query) use ($technician_ids) 
                {
                    $query->whereIn('id', $technician_ids)
                        ->orWhereNotIn('id', $technician_ids);
                })
                ->inRandomOrder()
                ->limit(3 - count($technician_ids))
                ->pluck('id')
                ->toArray();

                if (empty($available_technicians)) 
                {
                    if (count($technician_ids) < 2 || count($technician_ids) > 3) 
                    {
                        return response()->json(['message' => 'No additional technicians are available for the selected date and time.'], 400);
                    }
                    else 
                    {
                        return response()->json(['message' => 'No technicians are available for the selected date and time.'], 400);
                    }
                }

                $technician_ids = array_merge($technician_ids, $available_technicians);
            }
        }

        if (!empty($request->voucher_id)) {
            $voucher = Voucher::where('id', $request->voucher_id)->first();

            if (!$voucher) 
            {
                return response()->json(['message' => 'Invalid voucher ID!'], 400);
            }

            $existing_transaction = DB::table('voucher_transactions')
                ->where('voucher_id', $voucher->id)
                ->where('customer_id', $customer_id)
                ->first();
    
            if ($existing_transaction)
            {
                return response()->json(['message' => 'You have already used this voucher ID!'], 400);
            }
            elseif ($voucher->usage_count == 0) 
            {
                $voucher->voucher_status = 'redeemed';
                return response()->json(['message' => 'This voucher has already been fully used!'], 400);
            }
            elseif ($voucher->start_date > now()) {
                $voucher->voucher_status = 'inactive';
                $voucher->save();
                return response()->json(['message' => 'This voucher is not yet valid!'], 400);
            }
            elseif ($voucher->end_date < now()) {
                $voucher->voucher_status = 'expired';
                $voucher->save();
                return response()->json(['message' => 'This voucher has already expired!'], 400);
            }
            elseif ($voucher) 
            {
                $service->save();
        
                $service->technicians()->sync($technician_ids);

                $customer = $service->customer->user;

                Mail::to($customer->email)->send(new ServiceCreatedNotification($service));

                $admin = $service->admin->user;

                $technician_emails = $service->technicians()
                    ->wherePivot('service_id', $service->id)
                    ->with('user')
                    ->get()
                    ->pluck('user.email')
                    ->toArray();

                Mail::to($admin->email)->cc($technician_emails)->send(new AdminServiceCreatedNotification($service));
                
                $receiver_number = "+639917331994";
                $message = "Your booked service has been successfully created with ID: " . $service->id . ". The admin will now verify it.";
    
                try 
                {
                    $account_sid = "AC2cdee9c3cb2951f9cb7da0738284845e";
                    $auth_token = "6161b1a8dcff883b65d54170496a4d05";
                    $twilio_number = "+16813813689";
    
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

                $transaction->service_id = $service->id;
                $transaction->fill($request->only(['payment_method', 'amount', 'notes', 'transaction_date']));
                $transaction->save();

                $transaction->vouchers()->attach($voucher->id, ['customer_id' => $customer_id]);

                $voucher->voucher_status = 'active';
                $voucher->usage_count--;
                $voucher->save();
            }
        }
        else
        {
            $service->save();

            $service->technicians()->sync($technician_ids);

            $customer = $service->customer->user;

            Mail::to($customer->email)->send(new ServiceCreatedNotification($service));

            $admin = $service->admin->user;

            $technician_emails = $service->technicians()
                ->wherePivot('service_id', $service->id)
                ->with('user')
                ->get()
                ->pluck('user.email')
                ->toArray();

            Mail::to($admin->email)->cc($technician_emails)->send(new AdminServiceCreatedNotification($service));
            
            $receiver_number = "+639917331994";
            $message = "Your booked service has been successfully created with ID: " . $service->id . ". The admin will now verify it.";

            try 
            {
                $account_sid = "AC2cdee9c3cb2951f9cb7da0738284845e";
                $auth_token = "6161b1a8dcff883b65d54170496a4d05";
                $twilio_number = "+16813813689";

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

            $transaction->service_id = $service->id;
            $transaction->fill($request->only(['payment_method', 'amount', 'notes', 'transaction_date']));
            $transaction->save();
        }

        return response()->json([
            'message' => 'Service booked and created successfully!',
            'service' => $service,
        ], 201);
    }

    public function followupBook(Request $request, $id)
    {
        $validator = Validator::make($request->all(), 
        [
            'reason' => 'required|string',
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(), 400);
        }

        $service = Service::find($id);
        $service->service_status = 'followup';
        $service->save();

        $followup_service = FollowupService::create([
            'service_id' => $id,
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
        
        $receiver_number = "+639917331994";
        $message = "Your follow-up booked service has been successfully created with follow-up ID: " . $followup_service->id . ". The admin will now reschedule it.";

        try 
        {
            $account_sid = "AC2cdee9c3cb2951f9cb7da0738284845e";
            $auth_token = "6161b1a8dcff883b65d54170496a4d05";
            $twilio_number = "+16813813689";

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
    
    public function customerBookedServices($id)
    {
        $customer_id = $id;

        $services = DB::table('services')
            ->leftJoin('technician_services', 'services.id', '=', 'technician_services.service_id')
            ->leftJoin('technicians', 'technician_services.technician_id', '=', 'technicians.id')
            ->leftJoin('admins', 'services.admin_id', '=', 'admins.id')
            ->where('services.customer_id', $customer_id)
            ->whereIn('services.service_status', ['checking', 'pending'])
            ->select('services.id', 'services.book_type', 'services.service_type', 'services.ac_type', 'services.ac_brand', 'services.ac_hp', 'services.unit_type', 'services.no_unit', 'services.description', 'services.cooling', 'services.mechanical_noise', 'services.electric_connectivity', 'services.cooling', 'services.mechanical_noise', 'services.electric_connectivity', 'services.service_date', 'services.service_time', 'services.service_price', 'services.service_status', 'admins.last_name as admin_last_name','services.created_at', DB::raw('GROUP_CONCAT(technicians.last_name SEPARATOR ", ") as technician_last_names'))
            ->groupBy('services.id')
            ->get();

        return response()->json([
            'customer_booked' => $services
        ], 200);
    }
    
    public function customerFollowupServices($id)
    {
        $customer_id = $id;

        $followup_services = DB::table('followup_services')
            ->join('services', 'followup_services.service_id', '=', 'services.id')
            ->join('technician_followup_services', 'followup_services.id', '=', 'technician_followup_services.followup_service_id')
            ->join('technicians', 'technician_followup_services.technician_id', '=', 'technicians.id')
            ->leftJoin('admins', 'services.admin_id', '=', 'admins.id')
            ->leftJoin('users', 'admins.user_id', '=', 'users.id')
            ->where('services.customer_id', $customer_id)
            ->where('services.service_status', 'followup')
            ->where('followup_services.followup_status', 'pending')
            ->select('followup_services.*', 'admins.last_name as admin_last_name', 
                    DB::raw('CONCAT(users.phone_number, ", ", users.email) as admin_contact'),
                    DB::raw('GROUP_CONCAT(technicians.last_name SEPARATOR ", ") as technician_last_names'))
            ->groupBy('followup_services.id')
            ->orderByDesc('followup_services.id')
            ->get();

        return response($followup_services, 200);
    }

    public function customerFinishedServices($id)
    {
        $customer_id = $id;

        $services = DB::table('services')
            ->leftJoin('technician_services', 'services.id', '=', 'technician_services.service_id')
            ->leftJoin('technicians', 'technician_services.technician_id', '=', 'technicians.id')
            ->leftJoin('admins', 'services.admin_id', '=', 'admins.id')
            ->leftJoin('followup_services', 'services.id', '=', 'followup_services.service_id')
            ->where('services.customer_id', $customer_id)
            ->where('services.service_status', 'finished')
            ->orWhere(function ($query) use ($customer_id) {
                $query->where('services.customer_id', $customer_id)
                    ->where('services.service_status', 'followup')
                    ->where('followup_services.followup_status', 'finished');
            })
            ->select('services.id', 'services.book_type', 'services.service_type', 'services.ac_type', 'services.ac_brand', 'services.ac_hp', 'services.unit_type', 'services.no_unit', 'services.description', 'services.cooling', 'services.mechanical_noise', 'services.electric_connectivity', 'services.service_date', 'services.service_time', 'services.service_price', DB::raw('CASE WHEN services.service_status = "followup" THEN "finished" ELSE services.service_status END AS service_status'), 'admins.last_name as admin_last_name', DB::raw('GROUP_CONCAT(technicians.last_name SEPARATOR ", ") as technician_last_names'))
            ->groupBy('services.id')
            ->get();

        return response()->json([
            'customer_finished' => $services
        ], 200);
    }

    public function customerCompletedServices($id)
    {
        $customer_id = $id;

        $services = DB::table('services')
            ->leftJoin('technician_services', 'services.id', '=', 'technician_services.service_id')
            ->leftJoin('technicians', 'technician_services.technician_id', '=', 'technicians.id')
            ->leftJoin('admins', 'services.admin_id', '=', 'admins.id')
            ->leftJoin('followup_services', 'services.id', '=', 'followup_services.service_id')
            ->where('services.customer_id', $customer_id)
            ->where('services.service_status', 'completed')
            ->orWhere(function ($query) use ($customer_id) {
                $query->where('services.customer_id', $customer_id)
                    ->where('services.service_status', 'followup')
                    ->where('followup_services.followup_status', 'completed');
            })
            ->select('services.id', 'services.book_type', 'services.service_type', 'services.ac_type', 'services.ac_brand', 'services.ac_hp', 'services.unit_type', 'services.no_unit', 'services.description', 'services.cooling', 'services.mechanical_noise', 'services.electric_connectivity', 'services.service_date', 'services.service_time', 'services.service_price', DB::raw('CASE WHEN services.service_status = "followup" THEN "completed" ELSE services.service_status END AS service_status'), 'admins.last_name as admin_last_name', DB::raw('GROUP_CONCAT(technicians.last_name SEPARATOR ", ") as technician_last_names'))
            ->groupBy('services.id')
            ->get();

        return response()->json([
            'customer_completed' => $services
        ], 200);
    }

    public function customerCancelledServices($id)
    {
        $customer_id = $id;

        $services = DB::table('services')
            ->leftJoin('technician_services', 'services.id', '=', 'technician_services.service_id')
            ->leftJoin('technicians', 'technician_services.technician_id', '=', 'technicians.id')
            ->leftJoin('admins', 'services.admin_id', '=', 'admins.id')
            ->where('services.customer_id', $customer_id)
            ->where('services.service_status', 'cancelled')
            ->select('services.id', 'services.book_type', 'services.service_type', 'services.ac_type', 'services.ac_brand', 'services.ac_hp', 'services.unit_type', 'services.no_unit', 'services.description', 'services.cooling', 'services.mechanical_noise', 'services.electric_connectivity', 'services.service_date', 'services.service_time', 'services.service_price', 'services.service_status')
            ->groupBy('services.id')
            ->get();

        return response()->json([
            'customer_cancelled' => $services
        ], 200);
    }

    public function technicianAssignedServices($id)
    {
        $technician_id = $id;

        $services = DB::table('services')
            ->leftJoin('technician_services', 'services.id', '=', 'technician_services.service_id')
            ->leftJoin('technicians', 'technician_services.technician_id', '=', 'technicians.id')
            ->leftJoin('customers', 'services.customer_id', '=', 'customers.id')
            ->leftJoin('technician_services as ts2', 'services.id', '=', 'ts2.service_id')
            ->leftJoin('technicians as t2', 'ts2.technician_id', '=', 't2.id')
            ->leftJoin('admins', 'services.admin_id', '=', 'admins.id')
            ->leftJoin('users', 'customers.user_id', '=', 'users.id')
            ->where('technician_services.technician_id', $technician_id)
            ->whereIn('services.service_status', ['checking', 'pending'])
            ->select('services.id', 'services.book_type', 'services.service_type', 'services.ac_type', 'services.ac_brand', 'services.ac_hp', 'services.unit_type', 'services.no_unit', 'services.description', 'services.cooling', 'services.mechanical_noise', 'services.electric_connectivity', 'services.service_date', 'services.service_time', 'services.service_price', 'services.service_status', 'admins.last_name as admin_last_name', 
                DB::raw('GROUP_CONCAT(t2.last_name SEPARATOR ", ") as technician_last_names'),
                DB::raw('CONCAT(customers.first_name, " ", customers.last_name) as customer_full_name'),
                DB::raw('CONCAT(customers.property_type, ", ", customers.address, ", ", customers.barangay, ", ", customers.city, ", ", customers.province, ", ", customers.zip_code) as full_address'),
                DB::raw('CONCAT(users.phone_number, ", ", users.email) as full_contact'))
            ->groupBy('services.id')
            ->get();

        return response()->json([
            'technician_assigned' => $services
        ], 200);
    }

    public function technicianFollowupServices($id)
    {
        $technician_id = $id;

        $followup_services = DB::table('followup_services')
            ->leftJoin('technician_followup_services', 'followup_services.id', '=', 'technician_followup_services.followup_service_id')
            ->leftJoin('technicians', 'technician_followup_services.technician_id', '=', 'technicians.id')
            ->leftJoin('services', 'followup_services.service_id', '=', 'services.id')
            ->leftJoin('customers', 'services.customer_id', '=', 'customers.id')
            ->leftJoin('technician_followup_services as tfs2', 'followup_services.id', '=', 'tfs2.followup_service_id')
            ->leftJoin('technicians as t2', 'tfs2.technician_id', '=', 't2.id')
            ->leftJoin('admins', 'services.admin_id', '=', 'admins.id')
            ->leftJoin('users', 'customers.user_id', '=', 'users.id')
            ->where('technician_followup_services.technician_id', $technician_id)
            ->where('services.service_status', 'followup')
            ->where('followup_services.followup_status', 'pending')
            ->select('followup_services.*', 'customers.last_name as customer_last_name', 'admins.last_name as admin_last_name',
                DB::raw('CONCAT(customers.property_type, ", ", customers.address, ", ", customers.barangay, ", ", customers.city, ", ", customers.province, ", ", customers.zip_code) as full_address'),
                DB::raw('GROUP_CONCAT(t2.last_name SEPARATOR ", ") as technician_last_names'),
                DB::raw('CONCAT(users.phone_number, ", ", users.email) as full_contact'))
            ->groupBy('followup_services.id')
            ->orderByDesc('followup_services.id')
            ->get();

        
        return response()->json([
            'followup_services' => $followup_services
        ], 200);
    }

    public function technicianFinishedServices($id)
    {
        $technician_id = $id;

        $services = DB::table('services')
            ->leftJoin('technician_services', 'services.id', '=', 'technician_services.service_id')
            ->leftJoin('technicians', 'technician_services.technician_id', '=', 'technicians.id')
            ->leftJoin('customers', 'services.customer_id', '=', 'customers.id')
            ->leftJoin('technician_services as ts2', 'services.id', '=', 'ts2.service_id')
            ->leftJoin('technicians as t2', 'ts2.technician_id', '=', 't2.id')
            ->leftJoin('admins', 'services.admin_id', '=', 'admins.id')
            ->leftJoin('users', 'customers.user_id', '=', 'users.id')
            ->leftJoin('followup_services', 'services.id', '=', 'followup_services.service_id')
            ->where('technician_services.technician_id', $technician_id)
            ->where(function ($query) {
                $query->where('services.service_status', 'finished')
                    ->orWhere(function ($query) {
                        $query->where('services.service_status', 'followup')
                                ->where('followup_services.followup_status', 'finished');
                    });
            })
            ->select('services.id', 'services.book_type', 'services.service_type', 'services.ac_type', 'services.ac_brand', 'services.ac_hp', 'services.unit_type', 'services.no_unit', 'services.description', 'services.cooling', 'services.mechanical_noise', 'services.electric_connectivity', 'services.service_date', 'services.service_time', 'services.service_price', DB::raw('CASE WHEN services.service_status = "followup" THEN "finished" ELSE services.service_status END AS service_status'), 'admins.last_name as admin_last_name', 
                DB::raw('GROUP_CONCAT(t2.last_name SEPARATOR ", ") as technician_last_names'),
                DB::raw('CONCAT(customers.first_name, " ", customers.last_name) as customer_full_name'),
                DB::raw('CONCAT(customers.property_type, ", ", customers.address, ", ", customers.barangay, ", ", customers.city, ", ", customers.province, ", ", customers.zip_code) as full_address'),
                DB::raw('CONCAT(users.phone_number, ", ", users.email) as full_contact'))
            ->groupBy('services.id')
            ->get();

        return response()->json([
            'technician_finished' => $services
        ], 200);
    }

    public function technicianCompletedServices($id)
    {
        $technician_id = $id;

        $services = DB::table('services')
            ->leftJoin('technician_services', 'services.id', '=', 'technician_services.service_id')
            ->leftJoin('technicians', 'technician_services.technician_id', '=', 'technicians.id')
            ->leftJoin('customers', 'services.customer_id', '=', 'customers.id')
            ->leftJoin('technician_services as ts2', 'services.id', '=', 'ts2.service_id')
            ->leftJoin('technicians as t2', 'ts2.technician_id', '=', 't2.id')
            ->leftJoin('admins', 'services.admin_id', '=', 'admins.id')
            ->leftJoin('users', 'customers.user_id', '=', 'users.id')
            ->leftJoin('followup_services', 'services.id', '=', 'followup_services.service_id')
            ->where('technician_services.technician_id', $technician_id)
            ->where(function ($query) {
                $query->where('services.service_status', 'completed')
                    ->orWhere(function ($query) {
                        $query->where('services.service_status', 'followup')
                                ->where('followup_services.followup_status', 'completed');
                    });
            })
            ->select('services.id', 'services.book_type', 'services.service_type', 'services.ac_type', 'services.ac_brand', 'services.ac_hp', 'services.unit_type', 'services.no_unit', 'services.description', 'services.cooling', 'services.mechanical_noise', 'services.electric_connectivity', 'services.service_date', 'services.service_time', 'services.service_price', DB::raw('CASE WHEN services.service_status = "followup" THEN "completed" ELSE services.service_status END AS service_status'), 'admins.last_name as admin_last_name', 
                DB::raw('GROUP_CONCAT(t2.last_name SEPARATOR ", ") as technician_last_names'),
                DB::raw('CONCAT(customers.first_name, " ", customers.last_name) as customer_full_name'),
                DB::raw('CONCAT(customers.property_type, ", ", customers.address, ", ", customers.barangay, ", ", customers.city, ", ", customers.province, ", ", customers.zip_code) as full_address'),
                DB::raw('CONCAT(users.phone_number, ", ", users.email) as full_contact'))
            ->groupBy('services.id')
            ->get();

        return response()->json([
            'technician_completed' => $services
        ], 200);
    }

    public function customerCancelService(Request $request, $id)
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
        
        $receiver_number = "+639917331994";
        $message = "Your booked service with ID: " . $service->id . "has been updated to " . $service->service_status . " status because of " . $cancel->why . ".";

        try 
        {
            $account_sid = "AC2cdee9c3cb2951f9cb7da0738284845e";
            $auth_token = "6161b1a8dcff883b65d54170496a4d05";
            $twilio_number = "+16813813689";

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
            'message' => 'Cancelled service successfully!',
            'cancel' => $cancel,
        ], 201);
    }

    public function customerTransactionHistory($id)
    {
        $customer = Customer::find($id);
        $customer_id = $customer->id;

        $transactions = DB::table('transactions')
            ->join('services', 'transactions.service_id', '=', 'services.id')
            ->leftJoin('voucher_transactions', 'voucher_transactions.transaction_id', '=', 'transactions.id')
            ->leftJoin('vouchers', 'vouchers.id', '=', 'voucher_transactions.voucher_id')
            ->where('services.customer_id', $customer_id)
            ->where('transactions.transaction_status', '!=', 'cancelled')
            ->select('transactions.*', 'service_price', 'vouchers.id as voucher_id', 'discount')
            ->orderByDesc('transactions.id')
            ->get();

        return response($transactions, 200);
    }

    public function customerCancelledTransaction($id)
    {
        $customer = Customer::find($id);
        $customer_id = $customer->id;

        $transactions = DB::table('transactions')
            ->join('services', 'transactions.service_id', '=', 'services.id')
            ->leftJoin('voucher_transactions', 'voucher_transactions.transaction_id', '=', 'transactions.id')
            ->leftJoin('vouchers', 'vouchers.id', '=', 'voucher_transactions.voucher_id')
            ->where('services.customer_id', $customer_id)
            ->where('transactions.transaction_status', '=', 'cancelled')
            ->select('transactions.*', 'service_price', 'vouchers.id as voucher_id', 'discount')
            ->orderByDesc('transactions.id')
            ->get();

        return response($transactions, 200);
    }

    public function editTransaction(Request $request, $id)
    {
        $transaction = Transaction::find($id);

        $validator = Validator::make($request->all(), 
        [
            'payment_proof' => 'nullable|image|mimes:jpeg,png,jpg'  
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(), 400);
        }

        if ($request->hasFile('payment_proof')) 
        {
            $payment_proof = $request->file('payment_proof')->getClientOriginalName();
            $request->file('payment_proof')->storeAs('public/images', $payment_proof);
            $transaction->payment_proof = 'storage/images/'.$payment_proof;
            $transaction->transaction_date = $transaction->transaction_date ?? date('Y-m-d');
            $transaction->transaction_status = 'processing';
            $transaction->save();

            return response()->json([
                'message' => 'Payment proof uploaded successfully!',
            ], 200);
        }     

        return response()->json([
            'message' => 'No image file was provided',
        ], 400);
    }

    public function technicianServiceReport(Request $request, $id)
    {
        $service = Service::find($id);

        $service->service_status = $request->service_status;

        $image = 'public/storage/images/'.time().'.jpg';
        file_put_contents($image,base64_decode($request->image));
        $service->service_report = $image;
        $service->save();
        
        if ($service->service_status === 'finished') 
        {
            $receiver_number = "+639917331994";
            $message = "Your booked service with ID: " . $service->id . " has been updated to " . $service->service_status . " status.";
    
            try 
            {
                $account_sid = "AC2cdee9c3cb2951f9cb7da0738284845e";
                $auth_token = "6161b1a8dcff883b65d54170496a4d05";
                $twilio_number = "+16813813689";
    
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
        }

        return response()->json([
            'message' => 'Service updated successfully!',
            'service' => $service,
        ], 200);
    }

    public function technicianFollowupReport(Request $request, $id)
    {
        $followup_service = FollowupService::find($id);

        $followup_service->followup_status = $request->followup_status;

        $image = 'public/storage/images/'.time().'.jpg';
        file_put_contents($image,base64_decode($request->image));
        $followup_service->followup_report = $image;
        $followup_service->save();
        
        if ($followup_service->followup_status === 'finished') 
        {
            $receiver_number = "+639917331994";
            $message = "Your booked service with ID: " . $followup_service->id . " has been updated to " . $followup_service->followup_status . " status.";
    
            try 
            {
                $account_sid = "AC2cdee9c3cb2951f9cb7da0738284845e";
                $auth_token = "6161b1a8dcff883b65d54170496a4d05";
                $twilio_number = "+16813813689";
    
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
        }

        return response()->json([
            'message' => 'Followup service updated successfully!',
            'followup_service' => $followup_service,
        ], 200);
    }

    public function customerFeedback($id)
    {
        $customer = Customer::find($id);
        $customer_id = $customer->id;

        $service_feedbacks = DB::table('feedbacks')
            ->join('services', 'services.id', '=', 'feedbacks.service_id')
            ->leftJoin('followup_services', 'followup_services.service_id', '=', 'services.id')
            ->leftJoin('technician_services', 'services.id', '=', 'technician_services.service_id')
            ->leftJoin('technicians', 'technician_services.technician_id', '=', 'technicians.id')
            ->leftJoin('admins', 'services.admin_id', '=', 'admins.id')
            ->leftJoin('users', 'admins.user_id', '=', 'users.id')
            ->where('services.customer_id', $customer_id)
            ->where(function ($query) {
                $query->where('services.service_status', 'completed')
                    ->orWhere(function ($query) {
                        $query->where('followup_services.followup_status', 'completed')
                            ->where('followup_services.service_id', '!=', null);
                    });
            })
            ->select('feedbacks.id', 'feedbacks.service_id', 'feedbacks.rating', 'feedbacks.review', 'admins.last_name as admin_last_name',
                    DB::raw('CONCAT(users.phone_number, ", ", users.email) as admin_contact'),
                    DB::raw('GROUP_CONCAT(technicians.last_name SEPARATOR ", ") as technician_last_names'))
            ->groupBy('feedbacks.id')
            ->orderByDesc('feedbacks.id')
            ->get();

        return response($service_feedbacks, 200);
    }

    public function addFeedback(Request $request, $id)
    {
        $validator = Validator::make($request->all(), 
        [
            'service_id' => 'required|integer',
            'rating' => 'required|integer',
            'review' => 'required|string',
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(), 400);
        }

        $feedback = Feedback::create([
            'service_id' => $id,
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return response()->json([
            'message' => 'Service feedback submitted successfully!',
            'feedback' => $feedback,
        ], 201);
    }

    public function editFeedback(Request $request, $id)
    {
        $feedback = Feedback::find($id);
        $feedback->update($request->all());

        return response()->json([
            'message' => 'Service feedback updated successfully!',
            'feedback' => $feedback,
        ], 200);
    }
}