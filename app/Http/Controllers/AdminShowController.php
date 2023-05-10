<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AdminShowController extends Controller
{
    public function allServices()
    {
        $services = DB::table('services')
            ->leftJoin('technician_services', 'services.id', '=', 'technician_services.service_id')
            ->leftJoin('technicians', 'technician_services.technician_id', '=', 'technicians.id')
            ->leftJoin('customers', 'services.customer_id', '=', 'customers.id')
            ->leftJoin('admins', 'services.admin_id', '=', 'admins.id')
            ->leftJoin('users', 'customers.user_id', '=', 'users.id')
            ->whereIn('services.service_status', ['checking', 'pending'])
            ->select('services.*', 'customers.last_name as customer_last_name', 
                'admins.last_name as admin_last_name',
                DB::raw('CONCAT(customers.property_type, ", ", customers.address, ", ", customers.barangay, ", ", customers.city, ", ", customers.province, ", ", customers.zip_code) as full_address'),
                DB::raw('GROUP_CONCAT(technicians.last_name SEPARATOR ", ") as technician_last_names'),
                DB::raw('CONCAT(users.phone_number, ", ", users.email) as full_contact'))
            ->groupBy('services.id')
            ->orderByDesc('services.id')
            ->get();

        return response($services, 200);
    }

    public function allFinishedService()
    {
        $services = DB::table('services')
            ->leftJoin('technician_services', 'services.id', '=', 'technician_services.service_id')
            ->leftJoin('technicians', 'technician_services.technician_id', '=', 'technicians.id')
            ->leftJoin('customers', 'services.customer_id', '=', 'customers.id')
            ->leftJoin('admins', 'services.admin_id', '=', 'admins.id')
            ->leftJoin('users', 'customers.user_id', '=', 'users.id')
            ->where('services.service_status', 'finished')
            ->select('services.*', 'customers.last_name as customer_last_name', 
                'admins.last_name as admin_last_name',
                DB::raw('CONCAT(customers.property_type, ", ", customers.address, ", ", customers.barangay, ", ", customers.city, ", ", customers.province, ", ", customers.zip_code) as full_address'),
                DB::raw('GROUP_CONCAT(technicians.last_name SEPARATOR ", ") as technician_last_names'),
                DB::raw('CONCAT(users.phone_number, ", ", users.email) as full_contact'))
            ->groupBy('services.id')
            ->orderByDesc('services.id')
            ->get();

        return response($services, 200);
    }

    public function allCompletedService()
    {
        $services = DB::table('services')
            ->leftJoin('technician_services', 'services.id', '=', 'technician_services.service_id')
            ->leftJoin('technicians', 'technician_services.technician_id', '=', 'technicians.id')
            ->leftJoin('customers', 'services.customer_id', '=', 'customers.id')
            ->leftJoin('admins', 'services.admin_id', '=', 'admins.id')
            ->leftJoin('users', 'customers.user_id', '=', 'users.id')
            ->where('services.service_status', 'completed')
            ->select('services.*', 'customers.last_name as customer_last_name',
                'admins.last_name as admin_last_name', 
                DB::raw('CONCAT(customers.property_type, ", ", customers.address, ", ", customers.barangay, ", ", customers.city, ", ", customers.province, ", ", customers.zip_code) as full_address'),
                DB::raw('GROUP_CONCAT(technicians.last_name SEPARATOR ", ") as technician_last_names'),
                DB::raw('CONCAT(users.phone_number, ", ", users.email) as full_contact'))
            ->groupBy('services.id')
            ->orderByDesc('services.id')
            ->get();

        return response($services, 200);
    }

    public function allFollowUpService()
    {
        $followup_services = DB::table('followup_services')
            ->leftJoin('technician_followup_services', 'followup_services.id', '=', 'technician_followup_services.followup_service_id')
            ->leftJoin('technicians', 'technician_followup_services.technician_id', '=', 'technicians.id')
            ->leftJoin('services', 'followup_services.service_id', '=', 'services.id')
            ->leftJoin('customers', 'services.customer_id', '=', 'customers.id')
            ->leftJoin('admins', 'services.admin_id', '=', 'admins.id')
            ->leftJoin('users', 'customers.user_id', '=', 'users.id')
            ->where('services.service_status', 'followup')
            ->where('followup_services.followup_status', 'pending')
            ->select('followup_services.*', 'customers.last_name as customer_last_name', 
                'admins.last_name as admin_last_name',
                DB::raw('CONCAT(customers.property_type, ", ", customers.address, ", ", customers.barangay, ", ", customers.city, ", ", customers.province, ", ", customers.zip_code) as full_address'),
                DB::raw('GROUP_CONCAT(technicians.last_name SEPARATOR ", ") as technician_last_names'),
                DB::raw('CONCAT(users.phone_number, ", ", users.email) as full_contact'))
            ->groupBy('followup_services.id')
            ->orderByDesc('followup_services.id')
            ->get();

        return response($followup_services, 200);
    }
    
    public function allFollowupFinishedService()
    {
        $followup_services = DB::table('followup_services')
            ->leftJoin('technician_followup_services', 'followup_services.id', '=', 'technician_followup_services.followup_service_id')
            ->leftJoin('technicians', 'technician_followup_services.technician_id', '=', 'technicians.id')
            ->leftJoin('services', 'followup_services.service_id', '=', 'services.id')
            ->leftJoin('customers', 'services.customer_id', '=', 'customers.id')
            ->leftJoin('admins', 'services.admin_id', '=', 'admins.id')
            ->leftJoin('users', 'customers.user_id', '=', 'users.id')
            ->where('services.service_status', 'followup')
            ->where('followup_services.followup_status', 'finished')
            ->select('followup_services.*', 'customers.last_name as customer_last_name',
                'admins.last_name as admin_last_name',
                DB::raw('CONCAT(customers.property_type, ", ", customers.address, ", ", customers.barangay, ", ", customers.city, ", ", customers.province, ", ", customers.zip_code) as full_address'),
                DB::raw('GROUP_CONCAT(technicians.last_name SEPARATOR ", ") as technician_last_names'),
                DB::raw('CONCAT(users.phone_number, ", ", users.email) as full_contact'))
            ->groupBy('followup_services.id')
            ->orderByDesc('followup_services.id')
            ->get();

        return response($followup_services, 200);
    }

    public function allFollowupCompletedService()
    {
        $followup_services = DB::table('followup_services')
            ->leftJoin('technician_followup_services', 'followup_services.id', '=', 'technician_followup_services.followup_service_id')
            ->leftJoin('technicians', 'technician_followup_services.technician_id', '=', 'technicians.id')
            ->leftJoin('services', 'followup_services.service_id', '=', 'services.id')
            ->leftJoin('customers', 'services.customer_id', '=', 'customers.id')
            ->leftJoin('admins', 'services.admin_id', '=', 'admins.id')
            ->leftJoin('users', 'customers.user_id', '=', 'users.id')
            ->where('services.service_status', 'followup')
            ->where('followup_services.followup_status', 'completed')
            ->select('followup_services.*', 'customers.last_name as customer_last_name',
                'admins.last_name as admin_last_name',
                DB::raw('CONCAT(customers.property_type, ", ", customers.address, ", ", customers.barangay, ", ", customers.city, ", ", customers.province, ", ", customers.zip_code) as full_address'),
                DB::raw('GROUP_CONCAT(technicians.last_name SEPARATOR ", ") as technician_last_names'),
                DB::raw('CONCAT(users.phone_number, ", ", users.email) as full_contact'))
            ->groupBy('followup_services.id')
            ->orderByDesc('followup_services.id')
            ->get();

        return response($followup_services, 200);
    }

    public function allCancelledService()
    {
        $services = DB::table('services')
            ->leftJoin('customers', 'services.customer_id', '=', 'customers.id')
            ->leftJoin('users', 'customers.user_id', '=', 'users.id')
            ->leftJoin('cancels', 'services.id', '=', 'cancels.service_id')
            ->where('service_status', 'cancelled')
            ->select('services.*', 'customers.last_name as customer_last_name', 
                DB::raw('CONCAT(customers.property_type, ", ", customers.address, ", ", customers.barangay, ", ", customers.city, ", ", customers.province, ", ", customers.zip_code) as full_address'),
                DB::raw('CONCAT(users.phone_number, ", ", users.email) as full_contact'), 'cancels.why')
            ->orderByDesc('services.id')
            ->get();

        return response($services, 200);
    }

    public function allServiceWarranty()
    {
        $warranties = DB::table('warranties')
            ->join('services', 'warranties.service_id', '=', 'services.id')
            ->leftJoin('followup_services', 'services.id', '=', 'followup_services.service_id')
            ->where(function ($query) {
                $query->where('services.service_status', 'completed')
                    ->orWhere(function ($query) {
                        $query->where('followup_services.followup_status', 'completed')
                            ->where('followup_services.service_id', '!=', null);
                    });
            })
            ->select('warranties.*')
            ->orderByDesc('warranties.id')
            ->get();

        return response($warranties, 200);
    }

    public function allWarrantyClaim()
    {
        $warranty_claims = DB::table('warranty_claims')
            ->join('warranties', 'warranties.id', '=', 'warranty_claims.warranty_id')
            ->join('services', 'services.id', '=', 'warranties.service_id')
            ->select('warranty_claims.*', 'services.id as service_id', 'warranties.id as warranty_id')
            ->orderByDesc('warranty_claims.id')
            ->get();

        return response($warranty_claims, 200);
    }

    public function allTransaction()
    {
        $transactions = DB::table('transactions')
            ->join('services', 'transactions.service_id', '=', 'services.id')
            ->leftJoin('voucher_transactions', 'voucher_transactions.transaction_id', '=', 'transactions.id')
            ->leftJoin('vouchers', 'vouchers.id', '=', 'voucher_transactions.voucher_id')
            ->leftJoin('customers', 'services.customer_id', '=', 'customers.id')
            ->leftJoin('users', 'customers.user_id', '=', 'users.id')
            ->where('transactions.transaction_status', '!=', 'cancelled')
            ->select('transactions.*', 'service_price', 'vouchers.id as voucher_id', 'discount', 
                DB::raw('CONCAT(customers.first_name, " ", customers.last_name) AS customer_full_name'),
                DB::raw('CONCAT(customers.property_type, ", ", customers.address, ", ", customers.barangay, ", ", customers.city, ", ", customers.province, ", ", customers.zip_code) as full_address'),
                DB::raw('CONCAT(users.phone_number, ", ", users.email) as full_contact'))
            ->orderByDesc('transactions.id')
            ->get();

        return response($transactions, 200);
    }

    public function allCancelledTransaction()
    {
        $transactions = DB::table('transactions')
            ->join('services', 'transactions.service_id', '=', 'services.id')
            ->leftJoin('voucher_transactions', 'voucher_transactions.transaction_id', '=', 'transactions.id')
            ->leftJoin('vouchers', 'vouchers.id', '=', 'voucher_transactions.voucher_id')
            ->leftJoin('customers', 'services.customer_id', '=', 'customers.id')
            ->leftJoin('users', 'customers.user_id', '=', 'users.id')
            ->where('transactions.transaction_status', '=', 'cancelled')
            ->select('transactions.*', 'service_price', 'vouchers.id as voucher_id', 'discount', 
                DB::raw('CONCAT(customers.first_name, " ", customers.last_name) AS customer_full_name'),
                DB::raw('CONCAT(customers.property_type, ", ", customers.address, ", ", customers.barangay, ", ", customers.city, ", ", customers.province, ", ", customers.zip_code) as full_address'),
                DB::raw('CONCAT(users.phone_number, ", ", users.email) as full_contact'))
            ->orderByDesc('transactions.id')
            ->get();

        return response($transactions, 200);
    }

    public function allAttendance()
    {
        $attendances = DB::table('attendances')
            ->join('technicians', 'attendances.technician_id', '=', 'technicians.id')
            ->select('attendances.*', 'technicians.id as technician_id', DB::raw('CONCAT(technicians.first_name, " ", technicians.last_name) AS full_name'))
            ->orderByDesc('attendances.id')
            ->get();

        return response($attendances, 200);
    }
}
