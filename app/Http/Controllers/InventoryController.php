<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use Validator;

class InventoryController extends Controller
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
        $inventory = new Inventory;

        $validator = Validator::make($request->all(), 
        [
            'name' => 'required|string',
            'stock' => 'required|integer',
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(), 400);
        }

        $inventory->fill($request->all());
        $inventory->save();

        return response()->json([
            'message' => 'Inventory created successfully!',
            'inventory' => $inventory,
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
        return response(Inventory::where('id', $id)->first(), 200);
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
        $inventory = Inventory::find($id);
        $inventory->update($request->all());
        
        return response()->json([
            'message' => 'Inventory updated successfully!',
            'inventory' => $inventory,
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
        $inventory = Inventory::find($id);
        $inventory->delete();
        return response()->json(['message' => 'Inventory deleted successfully']);
    }
}
