<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Customer;
use App\Models\User;
use Validator;

class CustomerController extends Controller
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
        $customer = new Customer;

        $validator = Validator::make($request->all(), 
        [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
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

        $customer->fill($request->all());
        $customer->save();

        return response()->json([
            'message' => 'Customer created successfully!',
            'customer' => $customer,
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
        return response(Customer::where('id', $id)->with(['user', 'services'])->first(), 200);
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
        $customer = Customer::find($id);

        $validator = Validator::make($request->all(), 
        [
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
            $customer->image = 'storage/images/'.$filename;
        }

        $user = User::find($customer->user_id);

        if ($request->has('phone_number')) {
            $user->update([
                'phone_number' => $request->input('phone_number'),
                'full_name' => $request->input('first_name') . ' ' . $request->input('last_name'),
            ]);
        }        

        $customer->update([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);
        if (!is_null($customer->user_id)) 
        {
            $user = $customer->user;
            $customer->delete();
            $user->delete();
        } 
        else 
        {
            $customer->delete();
        }
        
        return response()->json(['message' => 'Customer and associated user deleted successfully!']);
    }
}
