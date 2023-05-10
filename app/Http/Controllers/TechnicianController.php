<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Technician;
use Auth;
use Validator;
Use Hash;

class TechnicianController extends Controller
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
            'age' => 'required|string',
            'experience' => 'required|string',
            'specialties' => 'required|string',
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
            'role' => 'technician',
        ]);

        $technician = Technician::create([
            'user_id' => $user->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'age' => $request->age,
            'experience' => $request->experience,
            'specialties' => $request->specialties,
        ]);

        return response()->json([
            'message' => 'Technician created and registered successfully!',
            'user' => $user,
            'technician' => $technician,
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
        return response(Technician::where('id', $id)->with('user')->first(), 200);
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
        $technician = Technician::find($id);

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
            $technician->image = 'storage/images/'.$filename;
        }

        $user = User::find($technician->user_id);

        $user->update([
            'phone_number' => $request->filled('phone_number') ? $request->input('phone_number') : $user->phone_number,
            'full_name' => $request->filled('first_name') ? $request->input('first_name') . ' '
                . ($request->filled('last_name') ? $request->input('last_name') : $technician->last_name)
                : $technician->first_name . ' ' . $technician->last_name,
        ]);

        $technician->update([
            'first_name' => $request->filled('first_name') ? $request->input('first_name') : $technician->first_name,
            'last_name' => $request->filled('last_name') ? $request->input('last_name') : $technician->last_name,
            'age' => $request->filled('age') ? $request->input('age') : $technician->age,
            'experience' => $request->filled('experience') ? $request->input('experience') : $technician->experience,
            'specialties' => $request->filled('specialties') ? $request->input('specialties') : $technician->specialties,
        ]);

        return response()->json([
            'message' => 'Technician updated successfully!',
            'technician' => $technician,
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
        $technician = Technician::find($id);
        if (!is_null($technician->user_id)) 
        {
            $user = $technician->user;
            $technician->delete();
            $user->delete();
        } 
        else 
        {
            $technician->delete();
        }
        
        return response()->json(['message' => 'Technician and associated user deleted successfully!'], 204);
    }
}
