<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Cancel;
use App\Models\Customer;
use App\Models\Service;
use App\Models\Technician;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Voucher;
use App\Models\Warranty;
use App\Mail\ServiceCreatedNotification;
use App\Mail\AdminServiceCreatedNotification;
use Carbon\Carbon;
use Twilio\Rest\Client;
use DB;
use Exception;
use Hash;
use Mail;
use Storage;
use Validator;

class ServiceController extends Controller
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
     * Store a newly guest created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guestStore(Request $request)
    {
        $service = new Service;
        $transaction = new Transaction();

        $validator = Validator::make($request->all(), 
        [
            'service_type' => 'required|string',
            'ac_type' => 'required|string',
            'ac_brand' => 'required|string',
            'ac_hp' => 'required|string',
            'unit_type' => 'required|string',
            'no_unit' => 'required|integer|min:1|max:10',
            'description' => 'required|string',
            'image.*' => 'nullable|image|mimes:jpeg,png,jpg',
            'cooling' => 'required|string',
            'mechanical_noise' => 'required|string',
            'electric_connectivity' => 'required|string',
            'service_date' => 'required|date',
            'service_time' => 'required|string',
            'service_price' => 'required|numeric',
            'service_report.*' => 'nullable|image|mimes:jpeg,png,jpg',
            'payment_method' => 'required|string',
            'amount' => 'required|numeric',
            'payment_proof' => 'nullable|image|mimes:jpeg,png,jpg',
            'notes' => 'nullable|string',
            'transaction_date' => 'nullable|date',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed',
            'phone_number' => 'required|regex:/(09)[0-9]{9}/',
            'address' => 'required|string',
            'barangay' => 'required|string',
            'city' => 'required|string',
            'province' => 'required|string',
            'zip_code' => 'required|string',
            'property_type' => 'required|string',
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

        $customer_id = $customer->id;

        auth('api')->login($user);

        $token = auth('api')->claims([
            'user_id' => $user->id,
            'customer_id' => $customer_id,
        ])->attempt($request->only(['email', 'password']));

        if ($request->hasFile('image')) {
            $image = $request->file('image')->getClientOriginalName();
            $filename = uniqid() . '_' . $image;
            $request->file('image')->storeAs('public/images', $filename);
            $service->image = 'storage/images/'.$filename;
        }   
        else 
        {
            $service->image = null;
        }

        if ($request->hasFile('payment_proof')) 
        {
            $payment_proof = $request->file('payment_proof')->getClientOriginalName();
            $filename = uniqid() . '_' . $payment_proof;
            $request->file('payment_proof')->storeAs('public/images', $filename);
            $transaction->payment_proof = 'storage/images/'.$filename;
            $transaction->transaction_date = $transaction->transaction_date ?? date('Y-m-d');
            $transaction->transaction_status = 'processing';
        } 
        else 
        {
            $transaction->payment_proof = null;
        }
        
        $service->customer_id = $customer_id;

        $service->fill($request->only(['book_type', 'service_type', 'ac_type', 'ac_brand', 'ac_hp', 'unit_type', 'no_unit', 'description', 'cooling', 'mechanical_noise', 'electric_connectivity', 'service_date', 'service_time', 'service_price']));

        $requested_admin_id = $request->input('admin_id');

        if(empty($requested_admin_id)) 
        {
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
        } 
        else 
        {
            $requested_admin = Admin::find($requested_admin_id);

            if ($requested_admin->services()->where('service_date', $request->service_date)->where('service_time', $request->service_time)->count() == 0) 
            {
                $service->admin_id = $requested_admin_id;
            } 
            else 
            {
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
            }
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
                return response()->json(['message' => 'The number of available technicians is not reach within the required range.'], 400);
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

                $receiver_number = "+639474805411";
                $message = "Your booked service has been successfully created with ID: " . $service->id . ". The admin will now verify it.";

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

            $receiver_number = "+639474805411";
            $message = "Your booked service has been successfully created with ID: " . $service->id . ". The admin will now verify it.";

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

            $transaction->service_id = $service->id;
            $transaction->fill($request->only(['payment_method', 'amount', 'notes', 'transaction_date']));
            $transaction->save();
        }

        return response()->json([
            'message' => 'Customer created and registered successfully! Service booked and created successfully!',
            'service' => $service,
            'user' => auth('api')->user(),
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL()*60,
        ], 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        $customer = $user->customer;
        $customer_id = $customer->id;

        $customer = Customer::find($customer_id);

        if (!$customer->address || !$customer->barangay || !$customer->city || !$customer->province || !$customer->zip_code || !$customer->property_type)
        {
            return response()->json(['message' => 'Please update your profile!'], 400);
        }

        $service = new Service;
        $transaction = new Transaction();

        $validator = Validator::make($request->all(), 
        [
            'service_type' => 'required|string',
            'ac_type' => 'required|string',
            'ac_brand' => 'required|string',
            'ac_hp' => 'required|string',
            'unit_type' => 'required|string',
            'no_unit' => 'required|integer|min:1|max:10',
            'description' => 'required|string',
            'image.*' => 'nullable|image|mimes:jpeg,png,jpg',
            'cooling' => 'required|string',
            'mechanical_noise' => 'required|string',
            'electric_connectivity' => 'required|string',
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
            $filename = uniqid() . '_' . $image;
            $request->file('image')->storeAs('public/images', $filename);
            $service->image = 'storage/images/'.$filename;
        }   
        else 
        {
            $service->image = null;
        }

        if ($request->hasFile('payment_proof')) 
        {
            $payment_proof = $request->file('payment_proof')->getClientOriginalName();
            $filename = uniqid() . '_' . $payment_proof;
            $request->file('payment_proof')->storeAs('public/images', $filename);
            $transaction->payment_proof = 'storage/images/'.$filename;
            $transaction->transaction_date = $transaction->transaction_date ?? date('Y-m-d');
            $transaction->transaction_status = 'processing';
        } 
        else 
        {
            $transaction->payment_proof = null;
        }
        
        $service->customer_id = $customer_id;

        $service->fill($request->only(['book_type', 'service_type', 'ac_type', 'ac_brand', 'ac_hp', 'unit_type', 'no_unit', 'description', 'cooling', 'mechanical_noise', 'electric_connectivity', 'service_date', 'service_time', 'service_price']));

        $requested_admin_id = $request->input('admin_id');

        if(empty($requested_admin_id)) 
        {
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
        } 
        else 
        {
            $requested_admin = Admin::find($requested_admin_id);

            if ($requested_admin->services()->where('service_date', $request->service_date)->where('service_time', $request->service_time)->count() == 0) 
            {
                $service->admin_id = $requested_admin_id;
            } 
            else 
            {
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
            }
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

                $receiver_number = "+639474805411";
                $message = "Your booked service has been successfully created with ID: " . $service->id . ". The admin will now verify it.";

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

            $receiver_number = "+639474805411";
            $message = "Your booked service has been successfully created with ID: " . $service->id . ". The admin will now verify it.";

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

            $transaction->service_id = $service->id;
            $transaction->fill($request->only(['payment_method', 'amount', 'notes', 'transaction_date']));
            $transaction->save();
        }

        return response()->json([
            'message' => 'Service booked and created successfully!',
            'service' => $service,
        ], 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function walkinStore(Request $request)
    {
        $customer_id = $request->customer_id;

        if (!isset($customer_id)) {
            return response()->json(['error' => 'Invalid request.']);
        }

        $customer = Customer::find($customer_id);

        if (!isset($customer)) {
            return response()->json(['error' => 'Customer not found.']);
        }

        if (!$customer->address || !$customer->barangay || !$customer->city || !$customer->province || !$customer->zip_code || !$customer->property_type)
        {
            return response()->json(['message' => 'Please update customer information!'], 400);
        }

        $service = new Service;
        $transaction = new Transaction();

        $validator = Validator::make($request->all(), 
        [
            'service_type' => 'required|string',
            'ac_type' => 'required|string',
            'ac_brand' => 'required|string',
            'ac_hp' => 'required|string',
            'unit_type' => 'required|string',
            'no_unit' => 'required|integer|min:1|max:10',
            'description' => 'required|string',
            'image.*' => 'nullable|image|mimes:jpeg,png,jpg',
            'cooling' => 'required|string',
            'mechanical_noise' => 'required|string',
            'electric_connectivity' => 'required|string',
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
            $filename = uniqid() . '_' . $image;
            $request->file('image')->storeAs('public/images', $filename);
            $service->image = 'storage/images/'.$filename;
        }   
        else 
        {
            $service->image = null;
        }

        if ($request->hasFile('payment_proof')) 
        {
            $payment_proof = $request->file('payment_proof')->getClientOriginalName();
            $filename = uniqid() . '_' . $payment_proof;
            $request->file('payment_proof')->storeAs('public/images', $filename);
            $transaction->payment_proof = 'storage/images/'.$filename;
            $transaction->transaction_date = $transaction->transaction_date ?? date('Y-m-d');
            $transaction->transaction_status = 'processing';
        } 
        else 
        {
            $transaction->payment_proof = null;
        }
        
        $service->customer_id = $customer_id;

        $service->fill($request->only(['book_type', 'service_type', 'ac_type', 'ac_brand', 'ac_hp', 'unit_type', 'no_unit', 'description', 'cooling', 'mechanical_noise', 'electric_connectivity', 'service_date', 'service_time', 'service_price']));

        $requested_admin_id = $request->input('admin_id');

        if(empty($requested_admin_id)) 
        {
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
        } 
        else 
        {
            $requested_admin = Admin::find($requested_admin_id);

            if ($requested_admin->services()->where('service_date', $request->service_date)->where('service_time', $request->service_time)->count() == 0) 
            {
                $service->admin_id = $requested_admin_id;
            } 
            else 
            {
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
            }
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

                $admin = $service->admin->user;

                $technician_emails = $service->technicians()
                    ->wherePivot('service_id', $service->id)
                    ->with('user')
                    ->get()
                    ->pluck('user.email')
                    ->toArray();

                Mail::to($admin->email)->cc($technician_emails)->send(new AdminServiceCreatedNotification($service));

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

            $admin = $service->admin->user;

            $technician_emails = $service->technicians()
                ->wherePivot('service_id', $service->id)
                ->with('user')
                ->get()
                ->pluck('user.email')
                ->toArray();

            Mail::to($admin->email)->cc($technician_emails)->send(new AdminServiceCreatedNotification($service));

            $transaction->service_id = $service->id;
            $transaction->fill($request->only(['payment_method', 'amount', 'notes', 'transaction_date']));
            $transaction->save();
        }

        return response()->json([
            'message' => 'Service booked and created successfully!',
            'service' => $service,
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
        return response(Service::where('id', $id)->with(['customer', 'technicians'])->first(), 200);
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
        $service = Service::find($id);

        $validator = Validator::make($request->all(), 
        [
            'service_report' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(), 400);
        }

        if ($request->hasFile('service_report')) {
            $service_report = $request->file('service_report')->getClientOriginalName();
            $filename = uniqid() . '_' . $service_report;
            $request->file('service_report')->storeAs('public/images', $filename);
            $service->service_report = 'storage/images/'.$filename;
            $service->service_status = 'finished';
        }     

        $service->update($request->except(['image', 'service_report']));

        $today_date = Carbon::today();
        $period = 15;
        $warranty_date = $today_date->copy()->addDays($period);

        if ($service->service_status === 'completed') {
            $warranty = new Warranty([
                'service_id' => $service->id,
                'warranty_type' => $service->service_type,
                'period' => $period,
                'start_date' => $today_date->format('Y-m-d'),
                'end_date' => $warranty_date->format('Y-m-d'),
            ]);
            $warranty->save();

            $receiver_number = "+639474805411";
            $message = "Your booked service with ID: " . $service->id . "has been updated to " . $service->service_status . " status.";

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
        }
        elseif ($service->service_status === 'cancelled' || $service->service_status === 'pending' || $service->service_status === 'finished' || $service->service_status === 'followup') 
        {
            $receiver_number = "+639474805411";
            $message = "Your booked service with ID: " . $service->id . " has been updated to " . $service->service_status . " status.";
        
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
            'message' => 'Service updated successfully!',
            'service' => $service,
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
        $service = Service::find($id);
        $service->delete();
        return response()->json(['message' => 'Service deleted successfully']);
    }

    /**
     * Search the service type.
     *
     * @param  str  $service_type
     * @return \Illuminate\Http\Response
     */
    public function search($service_type)
    {
        return response(Service::where('service_type', 'like', '%'.$service_type.'%')->get());
    }
}
