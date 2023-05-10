<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class TechnicianShowController extends Controller
{
    public function assignedServices()
    {
        $user = auth('api')->user();
        $technician = $user->technician;
        $technician_id = $technician->id;

        $services = DB::table('services')
            ->leftJoin('technician_services', 'services.id', '=', 'technician_services.service_id')
            ->leftJoin('technicians', 'technician_services.technician_id', '=', 'technicians.id')
            ->leftJoin('customers', 'services.customer_id', '=', 'customers.id')
            ->leftJoin('technician_services as ts2', 'services.id', '=', 'ts2.service_id')
            ->leftJoin('technicians as t2', 'ts2.technician_id', '=', 't2.id')
            ->leftJoin('admins', 'services.admin_id', '=', 'admins.id')
            ->leftJoin('users', 'customers.user_id', '=', 'users.id')
            ->where('technician_services.technician_id', $technician_id)
            ->where('services.service_status', 'pending')
            ->select('services.*', 'customers.last_name as customer_last_name', 'admins.last_name as admin_last_name', 
                DB::raw('CONCAT(customers.property_type, ", ", customers.address, ", ", customers.barangay, ", ", customers.city, ", ", customers.province, ", ", customers.zip_code) as full_address'),
                DB::raw('GROUP_CONCAT(t2.last_name SEPARATOR ", ") as technician_last_names'),
                DB::raw('CONCAT(users.phone_number, ", ", users.email) as full_contact'))
            ->groupBy('services.id')
            ->orderByDesc('services.id')
            ->get();

        return response($services, 200);
    }

    public function finishedAssignedService()
    {
        $user = auth('api')->user();
        $technician = $user->technician;
        $technician_id = $technician->id;

        $services = DB::table('services')
            ->leftJoin('technician_services', 'services.id', '=', 'technician_services.service_id')
            ->leftJoin('technicians', 'technician_services.technician_id', '=', 'technicians.id')
            ->leftJoin('customers', 'services.customer_id', '=', 'customers.id')
            ->leftJoin('technician_services as ts2', 'services.id', '=', 'ts2.service_id')
            ->leftJoin('technicians as t2', 'ts2.technician_id', '=', 't2.id')
            ->leftJoin('admins', 'services.admin_id', '=', 'admins.id')
            ->leftJoin('users', 'customers.user_id', '=', 'users.id')
            ->where('technician_services.technician_id', $technician_id)
            ->where('services.service_status', 'finished')
            ->select('services.*', 'customers.last_name as customer_last_name', 'admins.last_name as admin_last_name',
                DB::raw('CONCAT(customers.property_type, ", ", customers.address, ", ", customers.barangay, ", ", customers.city, ", ", customers.province, ", ", customers.zip_code) as full_address'),
                DB::raw('GROUP_CONCAT(t2.last_name SEPARATOR ", ") as technician_last_names'),
                DB::raw('CONCAT(users.phone_number, ", ", users.email) as full_contact'))
            ->groupBy('services.id')
            ->orderByDesc('services.id')
            ->get();

        return response($services, 200);
    }

    public function completedAssignedService()
    {
        $user = auth('api')->user();
        $technician = $user->technician;
        $technician_id = $technician->id;

        $services = DB::table('services')
            ->leftJoin('technician_services', 'services.id', '=', 'technician_services.service_id')
            ->leftJoin('technicians', 'technician_services.technician_id', '=', 'technicians.id')
            ->leftJoin('customers', 'services.customer_id', '=', 'customers.id')
            ->leftJoin('technician_services as ts2', 'services.id', '=', 'ts2.service_id')
            ->leftJoin('technicians as t2', 'ts2.technician_id', '=', 't2.id')
            ->leftJoin('admins', 'services.admin_id', '=', 'admins.id')
            ->leftJoin('users', 'customers.user_id', '=', 'users.id')
            ->where('technician_services.technician_id', $technician_id)
            ->where('services.service_status', 'completed')
            ->select('services.*', 'customers.last_name as customer_last_name', 'admins.last_name as admin_last_name',
                DB::raw('CONCAT(customers.property_type, ", ", customers.address, ", ", customers.barangay, ", ", customers.city, ", ", customers.province, ", ", customers.zip_code) as full_address'),
                DB::raw('GROUP_CONCAT(t2.last_name SEPARATOR ", ") as technician_last_names'),
                DB::raw('CONCAT(users.phone_number, ", ", users.email) as full_contact'))
            ->groupBy('services.id')
            ->orderByDesc('services.id')
            ->get();

        return response($services, 200);
    }

    public function followUpAssignedService()
    {
        $user = auth('api')->user();
        $technician = $user->technician;
        $technician_id = $technician->id;

        $followup_services = DB::table('followup_services')
            ->leftJoin('technician_followup_services', 'followup_services.id', '=', 'technician_followup_services.followup_service_id')
            ->leftJoin('technicians', 'technician_followup_services.technician_id', '=', 'technicians.id')
            ->leftJoin('services', 'followup_services.service_id', '=', 'services.id')
            ->leftJoin('customers', 'services.customer_id', '=', 'customers.id')
            ->leftJoin('technician_followup_services as tfs2', 'followup_services.id', '=', 'tfs2.followup_service_id')
            ->leftJoin('technicians as t2', 'tfs2.technician_id', '=', 't2.id')
            ->leftJoin('admins', 'services.admin_id', '=', 'admins.id')
            ->leftJoin('users', 'customers.user_id', '=', 'users.id')
            ->where('technician_followup_services.technician_id', $technician_id)
            ->where('services.service_status', 'followup')
            ->where('followup_services.followup_status', 'pending')
            ->select('followup_services.*', 'customers.last_name as customer_last_name', 'admins.last_name as admin_last_name',
                DB::raw('CONCAT(customers.property_type, ", ", customers.address, ", ", customers.barangay, ", ", customers.city, ", ", customers.province, ", ", customers.zip_code) as full_address'),
                DB::raw('GROUP_CONCAT(t2.last_name SEPARATOR ", ") as technician_last_names'),
                DB::raw('CONCAT(users.phone_number, ", ", users.email) as full_contact'))
            ->groupBy('followup_services.id')
            ->orderByDesc('followup_services.id')
            ->get();

        return response($followup_services, 200);
    }

    public function finishedFollowupAssignedService()
    {
        $user = auth('api')->user();
        $technician = $user->technician;
        $technician_id = $technician->id;

        $followup_services = DB::table('followup_services')
            ->leftJoin('technician_followup_services', 'followup_services.id', '=', 'technician_followup_services.followup_service_id')
            ->leftJoin('technicians', 'technician_followup_services.technician_id', '=', 'technicians.id')
            ->leftJoin('services', 'followup_services.service_id', '=', 'services.id')
            ->leftJoin('customers', 'services.customer_id', '=', 'customers.id')
            ->leftJoin('technician_followup_services as tfs2', 'followup_services.id', '=', 'tfs2.followup_service_id')
            ->leftJoin('technicians as t2', 'tfs2.technician_id', '=', 't2.id')
            ->leftJoin('admins', 'services.admin_id', '=', 'admins.id')
            ->leftJoin('users', 'customers.user_id', '=', 'users.id')
            ->where('technician_followup_services.technician_id', $technician_id)
            ->where('followup_services.followup_status', 'finished')
            ->select('followup_services.*', 'customers.last_name as customer_last_name', 'admins.last_name as admin_last_name',
                DB::raw('CONCAT(customers.property_type, ", ", customers.address, ", ", customers.barangay, ", ", customers.city, ", ", customers.province, ", ", customers.zip_code) as full_address'),
                DB::raw('GROUP_CONCAT(t2.last_name SEPARATOR ", ") as technician_last_names'),
                DB::raw('CONCAT(users.phone_number, ", ", users.email) as full_contact'))
            ->groupBy('followup_services.id')
            ->orderByDesc('followup_services.id')
            ->get();

        return response($followup_services, 200);
    }

    public function completedFollowupAssignedService()
    {
        $user = auth('api')->user();
        $technician = $user->technician;
        $technician_id = $technician->id;

        $followup_services = DB::table('followup_services')
            ->leftJoin('technician_followup_services', 'followup_services.id', '=', 'technician_followup_services.followup_service_id')
            ->leftJoin('technicians', 'technician_followup_services.technician_id', '=', 'technicians.id')
            ->leftJoin('services', 'followup_services.service_id', '=', 'services.id')
            ->leftJoin('customers', 'services.customer_id', '=', 'customers.id')
            ->leftJoin('technician_followup_services as tfs2', 'followup_services.id', '=', 'tfs2.followup_service_id')
            ->leftJoin('technicians as t2', 'tfs2.technician_id', '=', 't2.id')
            ->leftJoin('admins', 'services.admin_id', '=', 'admins.id')
            ->leftJoin('users', 'customers.user_id', '=', 'users.id')
            ->where('technician_followup_services.technician_id', $technician_id)
            ->where('followup_services.followup_status', 'completed')
            ->select('followup_services.*', 'customers.last_name as customer_last_name', 'admins.last_name as admin_last_name',
                DB::raw('CONCAT(customers.property_type, ", ", customers.address, ", ", customers.barangay, ", ", customers.city, ", ", customers.province, ", ", customers.zip_code) as full_address'),
                DB::raw('GROUP_CONCAT(t2.last_name SEPARATOR ", ") as technician_last_names'),
                DB::raw('CONCAT(users.phone_number, ", ", users.email) as full_contact'))
            ->groupBy('followup_services.id')
            ->orderByDesc('followup_services.id')
            ->get();

        return response($followup_services, 200);
    }

    public function technicianAttendance()
    {
        $user = auth('api')->user();
        $technician = $user->technician;
        $technician_id = $technician->id;

        $attendances = DB::table('attendances')
        ->where('technician_id', $technician_id)
        ->orderByDesc('attendance_date')
        ->get();

        return response($attendances, 200);
    }

    public function borrowInventory()
    {
        $user = auth('api')->user();
        $technician = $user->technician;
        $technician_id = $technician->id;

        $inventories = DB::table('inventories')
            ->select(['inventories.*', DB::raw('COUNT(technician_inventories.id) as borrow_count')])
            ->leftJoin('technician_inventories', function($join) use ($technician_id) {
                $join->on('inventories.id', '=', 'technician_inventories.inventory_id')
                    ->where('technician_inventories.technician_id', '=', $technician_id)
                    ->whereNull('technician_inventories.returned_date');
            })
            ->orderByDesc('inventories.id')
            ->groupBy('inventories.id')
            ->get();

        $inventories = $inventories->map(function ($inventory) use ($technician_id) {
            $isBorrowed = DB::table('technician_inventories')
                ->where('technician_id', $technician_id)
                ->where('inventory_id', $inventory->id)
                ->whereNull('returned_date')
                ->exists();
            $inventory->isBorrowed = $isBorrowed;
            return $inventory;
        });

        return response($inventories, 200);
    }

    public function returnInventory()
    {
        $user = auth('api')->user();
        $technician = $user->technician;
        $technician_id = $technician->id;

        $borrowed_inventories = DB::table('technician_inventories')
            ->where('technician_id', $technician_id)
            ->join('inventories', 'technician_inventories.inventory_id', '=', 'inventories.id')
            ->select('inventories.*', 'technician_inventories.quantity', 'technician_inventories.borrowed_date', 'technician_inventories.returned_date')
            ->orderByDesc('borrowed_date')
            ->get();

        return response($borrowed_inventories, 200);
    }
}
