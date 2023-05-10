<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Validator;

class TransactionController extends Controller
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
        return response(Transaction::where('id', $id)->with(['service', 'vouchers'])->first(), 200);
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
            $filename = uniqid() . '_' . $payment_proof;
            $request->file('payment_proof')->storeAs('public/images', $filename);
            $transaction->payment_proof = 'storage/images/'.$filename;
        }     

        $transaction->update($request->except(['payment_proof']));

        return response()->json([
            'message' => 'Transaction updated successfully!',
            'transaction' => $transaction,
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
