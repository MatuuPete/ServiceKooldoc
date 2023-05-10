<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voucher;
use Validator;
use Str;

class VoucherController extends Controller
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

    public function showAll()
    {
        return response()->json([
            'vouchers' => Voucher::all(),
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $voucher = new Voucher;

        $validator = Validator::make($request->all(), 
        [
            'discount' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'usage_count' => 'required|integer',
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(), 400);
        }

        do {
            $id = Str::random(6);
        } while (Voucher::where('id', $id)->exists());
        $voucher->id = $id;
        $voucher->fill($request->except('voucher_id'));
        $voucher->save();

        return response()->json([
            'message' => 'Voucher created successfully!',
            'voucher' => $voucher,
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
        return response(Voucher::where('id', $id)->first(), 200);
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
        $voucher = Voucher::find($id);
        $voucher->update($request->all());
        
        return response()->json([
            'message' => 'Voucher updated successfully!',
            'voucher' => $voucher,
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
        $voucher = Voucher::find($id);
        $voucher->delete();
        return response()->json(['message' => 'Voucher deleted successfully']);
    }
}
