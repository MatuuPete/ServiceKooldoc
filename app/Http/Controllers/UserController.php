<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use Auth;
Use Hash;
use Validator;

class UserController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response(User::where('id', $id)->with(['customer', 'technician', 'admin', 'superAdmin'])->first(), 200);
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
        $user = User::find($id);

        $validator = Validator::make($request->all(), 
        [
            'email' => [
                'required',
                'email',
                'ends_with:@gmail.com',
            ],
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

        $user->update([
            'email' => $request->input('email'),
            'phone_number' => $request->input('phone_number'),
        ]);

        return response()->json([
            'message' => 'User updated successfully!',
            'user' => $user,
        ], 200);
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|confirmed',
        ]);

        $user = auth('api')->user();

        if (!Hash::check($request->input('current_password'), $user->password)) {
            return response()->json(['message' => 'The provided current password is incorrect.'], 422);
        }

        $user->password = Hash::make($request->input('password'));
        $user->save();

        return response()->json(['message' => 'Password updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json(['message' => 'User deleted successfully']);
    }
}
