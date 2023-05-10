<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Technician;
use App\Models\Inventory;

class TechnicianInventoryController extends Controller
{
    public function assignInventory(Request $request, $id)
    {
        $user = auth()->user();
        $technician = $user->technician;
        $technician_id = $technician->id;

        $technician = Technician::find($technician_id);
        $inventory = Inventory::find($id);
        $quantity = $request->quantity;

        if ($inventory->stock < $quantity) {
            return response()->json([
                'message' => 'Insufficient stock for this item.',
            ], 400);
        }

        $technician->inventories()->attach($inventory, ['borrowed_date' => date('Y-m-d'), 'quantity' => $quantity]);
        $inventory->stock -= $quantity;
        $inventory->save();

        return response()->json([
            'message' => 'Inventory successfully assigned to technician.',
        ], 200);
    }

    public function unassignInventory($id)
    {
        $user = auth()->user();
        $technician = $user->technician;
        $technician_id = $technician->id;

        $technician = Technician::find($technician_id);
        $inventory = Inventory::find($id);

        $pivot = $technician->inventories()->where('inventory_id', $inventory->id)->latest()->first()->pivot;
        $quantity = $pivot->quantity;

        $technician->inventories()->updateExistingPivot($inventory->id, ['returned_date' => date('Y-m-d')]);

        $inventory->stock += $quantity;
        $inventory->save();

        return response()->json([
            'message' => 'Inventory successfully unassigned from technician.',
        ], 200);
    }
}
