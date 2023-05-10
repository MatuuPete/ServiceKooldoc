<?php

namespace App\Http\Controllers;

use App\Models\WarrantyClaim;
use App\Models\Warranty;
use Illuminate\Http\Request;
use Validator;

class WarrantyClaimController extends Controller
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
            'warranty_id' => 'required|integer',
            'statement' => 'required|string',
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(), 400);
        }

        $warranty = Warranty::find($request->warranty_id);

        if ($warranty->warranty_status == 'voided') 
        {
            $warranty_claim = new WarrantyClaim([
                'warranty_id' => $request->warranty_id,
                'claim_date' => date('Y-m-d'),
                'statement' => $request->statement,
                'claim_status' => 'closed'
            ]);
            $warranty_claim->save();
        }
        else if ($warranty->end_date < now()) 
        {
            $warranty->warranty_status = 'expired';
            $warranty->save();

            $warranty_claim = new WarrantyClaim([
                'warranty_id' => $request->warranty_id,
                'claim_date' => date('Y-m-d'),
                'statement' => $request->statement,
                'claim_status' => 'closed'
            ]);
            $warranty_claim->save();
        }
        else
        {
            $warranty->warranty_status = 'requested';
            $warranty->save();

            $warranty_claim = new WarrantyClaim([
                'warranty_id' => $request->warranty_id,
                'claim_date' => date('Y-m-d'),
                'statement' => $request->statement,
            ]);
            $warranty_claim->save();
        }

        return response()->json([
            'message' => 'Service warranty claim request successfully!',
            'warranty_claim' => $warranty_claim,
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
        return response(WarrantyClaim::where('id', $id)->with('warranty')->first(), 200);
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
        $warranty_claim = WarrantyClaim::find($id);
        $warranty_claim->update($request->all());
        
        return response()->json([
            'message' => 'Service warranty claim updated successfully!',
            'warranty_claim' => $warranty_claim,
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
        $warranty_claim = WarrantyClaim::find($id);
        $warranty_claim->delete();
        return response()->json(['message' => 'Service warranty claim deleted successfully']);
    }
}
