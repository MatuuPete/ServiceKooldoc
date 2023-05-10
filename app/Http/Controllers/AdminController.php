<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Admin;
use App\Models\User;
use Auth;
use Validator;
Use Hash;

class AdminController extends Controller
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
            'role' => 'admin',
        ]);

        $admin = Admin::create([
            'user_id' => $user->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'team_position' => $request->team_position,
        ]);

        return response()->json([
            'message' => 'Admin created and registered successfully!',
            'user' => $user,
            'admin' => $admin,
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
        return response(Admin::where('id', $id)->with('user')->first(), 200);
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
        $admin = Admin::find($id);

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
            $admin->image = 'storage/images/'.$filename;
        }

        $user = User::find($admin->user_id);

        $user->update([
            'phone_number' => $request->filled('phone_number') ? $request->input('phone_number') : $user->phone_number,
            'full_name' => $request->filled('first_name') ? $request->input('first_name') . ' '
                . ($request->filled('last_name') ? $request->input('last_name') : $admin->last_name)
                : $admin->first_name . ' ' . $admin->last_name,
        ]);

        $admin->update([
            'first_name' => $request->filled('first_name') ? $request->input('first_name') : $admin->first_name,
            'last_name' => $request->filled('last_name') ? $request->input('last_name') : $admin->last_name,
            'team_position' => $request->filled('team_position') ? $request->input('team_position') : $admin->team_position,
        ]);

        return response()->json([
            'message' => 'Admin updated successfully!',
            'admin' => $admin,
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
        $admin = Admin::find($id);
        if (!is_null($admin->user_id)) 
        {
            $user = $admin->user;
            $admin->delete();
            $user->delete();
        } 
        else 
        {
            $admin->delete();
        }
        
        return response()->json(['message' => 'Admin and associated user deleted successfully!'], 204);
    }
}
