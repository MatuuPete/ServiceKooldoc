<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\SuperAdmin;
use Auth;
use Validator;
Use Hash;

class SuperAdminController extends Controller
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
            'team_position' => 'required|string',
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(), 400);
        }

        $user = User::create([
            'full_name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_number' => $request->phone_number,
            'role' => 'super admin',
        ]);

        $super_admin = SuperAdmin::create([
            'user_id' => $user->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'team_position' => $request->team_position,
        ]);

        return response()->json([
            'message' => 'Super admin created and registered successfully!',
            'user' => $user,
            'super admin' => $super_admin,
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
        return response(SuperAdmin::where('id', $id)->with('user')->first(), 200);
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
        $super_admin = SuperAdmin::find($id);

        $validator = Validator::make($request->all(), 
        [
            'phone_number' => [
                'required',
                'regex:/\+63[0-9]{10}/',
                Rule::unique('users')->where(function ($query) use ($request) {
                    return $query->where('phone_number', $request->phone_number);
                }),
            ],
            'image' => 'nullable|image|mimes:jpeg,png,jpg'  
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(), 400);
        }

        if ($request->hasFile('image')) 
        {
            $image = $request->file('image')->getClientOriginalName();
            $filename = uniqid() . '_' . $image;
            $request->file('image')->storeAs('public/images', $filename);
            $super_admin->image = 'storage/images/'.$filename;
        }

        $user = User::find($super_admin->user_id);

        $user->update([
            'phone_number' => $request->filled('phone_number') ? $request->input('phone_number') : $user->phone_number,
            'full_name' => $request->filled('first_name') ? $request->input('first_name') . ' '
                . ($request->filled('last_name') ? $request->input('last_name') : $super_admin->last_name)
                : $super_admin->first_name . ' ' . $super_admin->last_name,
        ]);

        $super_admin->update([
            'first_name' => $request->filled('first_name') ? $request->input('first_name') : $super_admin->first_name,
            'last_name' => $request->filled('last_name') ? $request->input('last_name') : $super_admin->last_name,
            'team_position' => $request->filled('team_position') ? $request->input('team_position') : $super_admin->team_position,
        ]);

        return response()->json([
            'message' => 'Super admin updated successfully!',
            'super admin' => $super_admin,
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
        $super_admin = SuperAdmin::find($id);
        if (!is_null($super_admin->user_id)) 
        {
            $user = $super_admin->user;
            $super_admin->delete();
            $user->delete();
        } 
        else 
        {
            $super_admin->delete();
        }
        
        return response()->json(['message' => 'Super admin and associated user deleted successfully!'], 204);
    }
}
