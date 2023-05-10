<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Customer;
use App\Models\User;
use Auth;
use DB;
Use Hash;
use Validator;

class AuthController extends Controller
{
    public function register(Request $request)
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
                'regex:/\+63[0-9]{10}/',
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
        ]);

        return response()->json([
            'message' => 'Customer created and registered successfully!',
            'user' => $user,
            'customer' => $customer,
        ], 201);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), 
        [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(), 400);
        }

        if(!$token = auth('api')->attempt($validator->validated()))
        {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {   
        $user = auth('api')->user();

        return response()->json([
            'user' => $user,
            'message' => 'User successfully logged in!',
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL()*120,
        ], 200);
    }

    public function profile()
    {
        $user = auth('api')->user();
        $user_data;

        if ($user->role === 'super admin') 
        {
            $user_data = DB::table('users')
                        ->select('email', 'phone_number', 'super_admins.*')
                        ->leftJoin('super_admins', 'users.id', '=', 'super_admins.user_id')
                        ->where('users.id', '=', $user->id)
                        ->first();
        } 
        elseif ($user->role === 'admin') 
        {
            $user_data = DB::table('users')
                        ->select('email', 'phone_number', 'admins.*')
                        ->leftJoin('admins', 'users.id', '=', 'admins.user_id')
                        ->where('users.id', '=', $user->id)
                        ->first();
        } 
        elseif ($user->role === 'technician') 
        {
            $user_data = DB::table('users')
                        ->select('email', 'phone_number', 'technicians.*')
                        ->leftJoin('technicians', 'users.id', '=', 'technicians.user_id')
                        ->where('users.id', '=', $user->id)
                        ->first();
        } 
        else 
        {
            $user_data = DB::table('users')
                        ->select('email', 'phone_number', 'customers.*')
                        ->leftJoin('customers', 'users.id', '=', 'customers.user_id')
                        ->where('users.id', '=', $user->id)
                        ->first();
        }

        return response()->json([
            'user' => $user,
            'user_data' => $user_data
        ], 200);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    public function logout()
    {
        auth('api')->logout();
    
        return response()->json(['message' => 'User successfully logged out!'], 200);
    }
}
