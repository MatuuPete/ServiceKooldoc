<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CustomerShowController extends Controller
{
    public function bookedServices()
    {
        $user = auth()->user();
        $customer = $user->customer;
        $customer_id = $customer->id;

        $services = DB::table('services')
            ->leftJoin('technician_services', 'services.id', '=', 'technician_services.service_id')
            ->leftJoin('technicians', 'technician_services.technician_id', '=', 'technicians.id')
            ->leftJoin('admins', 'services.admin_id', '=', 'admins.id')
            ->leftJoin('users', 'admins.user_id', '=', 'users.id')
            ->where('services.customer_id', $customer_id)
            ->whereIn('services.service_status', ['checking', 'pending'])
            ->select('services.*', 'admins.last_name as admin_last_name', 
                    DB::raw('GROUP_CONCAT(technicians.last_name SEPARATOR ", ") as technician_last_names'),
                    DB::raw('CONCAT(users.phone_number, ", ", users.email) as admin_contact'))
            ->groupBy('services.id')
            ->get();

        return response($services, 200);
    }

    public function finishedBookedService()
    {
        $user = auth()->user();
        $customer = $user->customer;
        $customer_id = $customer->id;

        $services = DB::table('services')
            ->leftJoin('technician_services', 'services.id', '=', 'technician_services.service_id')
            ->leftJoin('technicians', 'technician_services.technician_id', '=', 'technicians.id')
            ->leftJoin('admins', 'services.admin_id', '=', 'admins.id')
            ->leftJoin('users', 'admins.user_id', '=', 'users.id')
            ->where('services.customer_id', $customer_id)
            ->where('services.service_status', 'finished')
            ->select('services.*', 'admins.last_name as admin_last_name', 
                    DB::raw('GROUP_CONCAT(technicians.last_name SEPARATOR ", ") as technician_last_names'),
                    DB::raw('CONCAT(users.phone_number, ", ", users.email) as admin_contact'))
            ->groupBy('services.id')
            ->orderByDesc('services.id')
            ->get();

        return response($services, 200);
    }

    public function completedBookedService()
    {
        $user = auth()->user();
        $customer = $user->customer;
        $customer_id = $customer->id;

        $services = DB::table('services')
            ->leftJoin('technician_services', 'services.id', '=', 'technician_services.service_id')
            ->leftJoin('technicians', 'technician_services.technician_id', '=', 'technicians.id')
            ->leftJoin('admins', 'services.admin_id', '=', 'admins.id')
            ->leftJoin('users', 'admins.user_id', '=', 'users.id')
            ->leftJoin('feedbacks', 'services.id', '=', 'feedbacks.service_id')
            ->leftJoin('post_consultations', 'services.id', '=', 'post_consultations.service_id')
            ->where('services.customer_id', $customer_id)
            ->where('services.service_status', 'completed')
            ->select('services.*', 'admins.last_name as admin_last_name', 'feedbacks.id as feedback_id',         
                    'post_consultations.id as post_consultation_id', 
                    DB::raw('GROUP_CONCAT(technicians.last_name SEPARATOR ", ") as technician_last_names'),
                    DB::raw('CONCAT(users.phone_number, ", ", users.email) as admin_contact'))
            ->groupBy('services.id')
            ->orderByDesc('services.id')
            ->get();

        return response($services, 200);
    }

    public function followUpBookedService()
    {
        $user = auth()->user();
        $customer = $user->customer;
        $customer_id = $customer->id;

        $followup_services = DB::table('followup_services')
            ->join('services', 'followup_services.service_id', '=', 'services.id')
            ->join('technician_followup_services', 'followup_services.id', '=', 'technician_followup_services.followup_service_id')
            ->join('technicians', 'technician_followup_services.technician_id', '=', 'technicians.id')
            ->leftJoin('admins', 'services.admin_id', '=', 'admins.id')
            ->leftJoin('users', 'admins.user_id', '=', 'users.id')
            ->where('services.customer_id', $customer_id)
            ->where('services.service_status', 'followup')
            ->where('followup_services.followup_status', 'pending')
            ->select('followup_services.*', 'admins.last_name as admin_last_name', 
                    DB::raw('CONCAT(users.phone_number, ", ", users.email) as admin_contact'),
                    DB::raw('GROUP_CONCAT(technicians.last_name SEPARATOR ", ") as technician_last_names'))
            ->groupBy('followup_services.id')
            ->orderByDesc('followup_services.id')
            ->get();

        return response($followup_services, 200);
    }

    public function finishedFollowUpBookedService()
    {
        $user = auth()->user();
        $customer = $user->customer;
        $customer_id = $customer->id;

        $followup_services = DB::table('followup_services')
            ->join('services', 'followup_services.service_id', '=', 'services.id')
            ->join('technician_followup_services', 'followup_services.id', '=', 'technician_followup_services.followup_service_id')
            ->join('technicians', 'technician_followup_services.technician_id', '=', 'technicians.id')
            ->leftJoin('admins', 'services.admin_id', '=', 'admins.id')
            ->leftJoin('users', 'admins.user_id', '=', 'users.id')
            ->where('services.customer_id', $customer_id)
            ->where('services.service_status', 'followup')
            ->where('followup_services.followup_status', 'finished')
            ->select('followup_services.*', 'admins.last_name as admin_last_name', 
                    DB::raw('CONCAT(users.phone_number, ", ", users.email) as admin_contact'),
                    DB::raw('GROUP_CONCAT(technicians.last_name SEPARATOR ", ") as technician_last_names'))
            ->groupBy('followup_services.id')
            ->orderByDesc('followup_services.id')
            ->get();

        return response($followup_services, 200);
    }

    public function completedFollowupBookedService()
    {
        $user = auth()->user();
        $customer = $user->customer;
        $customer_id = $customer->id;

        $followup_services = DB::table('followup_services')
            ->join('services', 'followup_services.service_id', '=', 'services.id')
            ->join('technician_followup_services', 'followup_services.id', '=', 'technician_followup_services.followup_service_id')
            ->join('technicians', 'technician_followup_services.technician_id', '=', 'technicians.id')
            ->leftJoin('admins', 'services.admin_id', '=', 'admins.id')
            ->leftJoin('users', 'admins.user_id', '=', 'users.id')
            ->leftJoin('feedbacks', 'services.id', '=', 'feedbacks.service_id')
            ->leftJoin('post_consultations', 'services.id', '=', 'post_consultations.service_id')
            ->where('services.customer_id', $customer_id)
            ->where('followup_services.followup_status', 'completed')
            ->select('followup_services.*', 'admins.last_name as admin_last_name', 'feedbacks.id as feedback_id', 'post_consultations.id as post_consultation_id', 
                    DB::raw('CONCAT(users.phone_number, ", ", users.email) as admin_contact'),
                    DB::raw('GROUP_CONCAT(technicians.last_name SEPARATOR ", ") as technician_last_names'))
            ->groupBy('followup_services.id')
            ->orderByDesc('followup_services.id')
            ->get();

        return response($followup_services, 200);
    }

    public function cancelledService()
    {
        $user = auth()->user();
        $customer = $user->customer;
        $customer_id = $customer->id;

        $services = DB::table('services')
            ->leftJoin('admins', 'services.admin_id', '=', 'admins.id')
            ->leftJoin('users', 'admins.user_id', '=', 'users.id')
            ->leftJoin('cancels', 'services.id', '=', 'cancels.service_id')
            ->where('customer_id', $customer_id)
            ->where('service_status', 'cancelled')
            ->select('services.*', 'cancels.why')
            ->orderByDesc('services.id')
            ->get();

        return response($services, 200);
    }

    public function serviceFeedback()
    {
        $user = auth()->user();
        $customer = $user->customer;
        $customer_id = $customer->id;

        $service_feedbacks = DB::table('feedbacks')
            ->join('services', 'services.id', '=', 'feedbacks.service_id')
            ->leftJoin('followup_services', 'followup_services.service_id', '=', 'services.id')
            ->leftJoin('technician_services', 'services.id', '=', 'technician_services.service_id')
            ->leftJoin('technicians', 'technician_services.technician_id', '=', 'technicians.id')
            ->leftJoin('admins', 'services.admin_id', '=', 'admins.id')
            ->leftJoin('users', 'admins.user_id', '=', 'users.id')
            ->where('services.customer_id', $customer_id)
            ->where(function ($query) {
                $query->where('services.service_status', 'completed')
                    ->orWhere(function ($query) {
                        $query->where('followup_services.followup_status', 'completed')
                            ->where('followup_services.service_id', '!=', null);
                    });
            })
            ->select('feedbacks.*', 'admins.last_name as admin_last_name',
                    DB::raw('CONCAT(users.phone_number, ", ", users.email) as admin_contact'),
                    DB::raw('GROUP_CONCAT(technicians.last_name SEPARATOR ", ") as technician_last_names'))
            ->groupBy('feedbacks.id')
            ->orderByDesc('feedbacks.id')
            ->get();

        return response($service_feedbacks, 200);
    }

    public function servicePostConsultation()
    {
        $user = auth()->user();
        $customer = $user->customer;
        $customer_id = $customer->id;

        $post_consultations = DB::table('post_consultations')
            ->join('services', 'services.id', '=', 'post_consultations.service_id')
            ->leftJoin('followup_services', 'followup_services.service_id', '=', 'services.id')
            ->leftJoin('technician_services', 'services.id', '=', 'technician_services.service_id')
            ->leftJoin('technicians', 'technician_services.technician_id', '=', 'technicians.id')
            ->leftJoin('admins', 'services.admin_id', '=', 'admins.id')
            ->leftJoin('users', 'admins.user_id', '=', 'users.id')
            ->where('services.customer_id', $customer_id)
            ->where(function ($query) {
                $query->where('services.service_status', 'completed')
                    ->orWhere(function ($query) {
                        $query->where('followup_services.followup_status', 'completed')
                            ->where('followup_services.service_id', '!=', null);
                    });
            })
            ->select('post_consultations.*', 'admins.last_name as admin_last_name',
                    DB::raw('CONCAT(users.phone_number, ", ", users.email) as admin_contact'),
                    DB::raw('GROUP_CONCAT(technicians.last_name SEPARATOR ", ") as technician_last_names'))
            ->groupBy('post_consultations.id')
            ->orderByDesc('post_consultations.id')
            ->get();

        return response($post_consultations, 200);
    }

    public function serviceWarranty()
    {
        $user = auth()->user();
        $customer = $user->customer;
        $customer_id = $customer->id;

        $warranties = DB::table('warranties')
            ->join('services', 'warranties.service_id', '=', 'services.id')
            ->leftJoin('followup_services', 'services.id', '=', 'followup_services.service_id')
            ->leftJoin('warranty_claims', 'warranties.id', '=', 'warranty_claims.warranty_id')
            ->leftJoin('feedbacks', 'services.id', '=', 'feedbacks.service_id')
            ->where('services.customer_id', $customer_id)
            ->where(function ($query) {
                $query->where('services.service_status', 'completed')
                    ->orWhere(function ($query) {
                        $query->where('followup_services.followup_status', 'completed')
                            ->where('followup_services.service_id', '!=', null);
                    });
            })
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('feedbacks')
                    ->whereRaw('feedbacks.service_id = services.id');
            })
            ->select('warranties.*', 'warranty_claims.id as warranty_claim_id')
            ->orderByDesc('warranties.id')
            ->get();

        return response($warranties, 200);
    }

    public function warrantyClaim()
    {
        $user = auth()->user();
        $customer = $user->customer;
        $customer_id = $customer->id;

        $warranty_claims = DB::table('warranty_claims')
            ->join('warranties', 'warranties.id', '=', 'warranty_claims.warranty_id')
            ->join('services', 'services.id', '=', 'warranties.service_id')
            ->where('services.customer_id', $customer_id)
            ->select('warranty_claims.*', 'services.id as service_id', 'warranties.id as warranty_id')
            ->orderByDesc('warranty_claims.id')
            ->get();

        return response($warranty_claims, 200);
    }

    public function transactionHistories()
    {
        $user = auth()->user();
        $customer = $user->customer;
        $customer_id = $customer->id;

        $transactions = DB::table('transactions')
            ->join('services', 'transactions.service_id', '=', 'services.id')
            ->leftJoin('voucher_transactions', 'voucher_transactions.transaction_id', '=', 'transactions.id')
            ->leftJoin('vouchers', 'vouchers.id', '=', 'voucher_transactions.voucher_id')
            ->where('services.customer_id', $customer_id)
            ->where('transactions.transaction_status', '!=', 'cancelled')
            ->select('transactions.*', 'service_price', 'vouchers.id as voucher_id', 'discount')
            ->orderByDesc('transactions.id')
            ->get();

        return response($transactions, 200);
    }

    public function cancelledTransactionHistory()
    {
        $user = auth()->user();
        $customer = $user->customer;
        $customer_id = $customer->id;

        $transactions = DB::table('transactions')
            ->join('services', 'transactions.service_id', '=', 'services.id')
            ->leftJoin('voucher_transactions', 'voucher_transactions.transaction_id', '=', 'transactions.id')
            ->leftJoin('vouchers', 'vouchers.id', '=', 'voucher_transactions.voucher_id')
            ->where('services.customer_id', $customer_id)
            ->where('transactions.transaction_status', '=', 'cancelled')
            ->select('transactions.*', 'service_price', 'vouchers.id as voucher_id', 'discount')
            ->orderByDesc('transactions.id')
            ->get();

        return response($transactions, 200);
    }
}
