<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class SuperAdminShowController extends Controller
{
    public function multiBookings()
    {
        $daily_bookings = DB::table('services')
            ->select(DB::raw('DATE_FORMAT(service_date, "%Y-%m-%d") as day'), 
                DB::raw('COUNT(*) as total_count'), 
                DB::raw('SUM(CASE WHEN service_type = "cleaning" THEN 1 ELSE 0 END) as cleaning_count'), 
                DB::raw('SUM(CASE WHEN service_type = "installation" THEN 1 ELSE 0 END) as installation_count'), 
                DB::raw('SUM(CASE WHEN service_type = "maintenance" THEN 1 ELSE 0 END) as maintenance_count'), 
                DB::raw('SUM(CASE WHEN service_type = "repair" THEN 1 ELSE 0 END) as repair_count'))
            ->whereNotNull('service_date')
            ->whereDate('service_date', Carbon::now()->toDateString())
            ->whereIn('service_type', ['cleaning', 'installation', 'maintenance', 'repair'])
            ->groupBy(DB::raw('DATE_FORMAT(service_date, "%Y-%m-%d")'))
            ->orderBy(DB::raw('service_date'))
            ->get();

        $formatted_daily_bookings = $daily_bookings->map(function($item) {
            $day_date = Carbon::createFromFormat('Y-m-d', $item->day);
            return [
                'day' => $day_date->format('d M Y'),
                'total_count' => $item->total_count + 0.1,
                'cleaning_count' => $item->cleaning_count + 0.1,
                'installation_count' => $item->installation_count + 0.1,
                'maintenance_count' => $item->maintenance_count + 0.1,
                'repair_count' => $item->repair_count + 0.1,
            ];
        });

        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $weekly_bookings = DB::table('services')
            ->select(DB::raw('DATE_FORMAT(service_date, "%Y-%m-%d") as day'), 
                DB::raw('COUNT(*) as total_count'), 
                DB::raw('SUM(CASE WHEN service_type = "cleaning" THEN 1 ELSE 0 END) as cleaning_count'), 
                DB::raw('SUM(CASE WHEN service_type = "installation" THEN 1 ELSE 0 END) as installation_count'), 
                DB::raw('SUM(CASE WHEN service_type = "maintenance" THEN 1 ELSE 0 END) as maintenance_count'), 
                DB::raw('SUM(CASE WHEN service_type = "repair" THEN 1 ELSE 0 END) as repair_count'))
            ->whereNotNull('service_date')
            ->whereIn('service_type', ['cleaning', 'installation', 'maintenance', 'repair'])
            ->whereBetween('service_date', [$startOfWeek->toDateString(), $endOfWeek->toDateString()])
            ->groupBy(DB::raw('DATE_FORMAT(service_date, "%Y-%m-%d")'))
            ->orderBy(DB::raw('service_date'));

        $formatted_weekly_bookings = $weekly_bookings->get();
        $formatted_weekly_bookings = $formatted_weekly_bookings->map(function($item) {
            $day_date = Carbon::createFromFormat('Y-m-d', $item->day);
            return [
                'day' => $day_date->format('D d M Y'),
                'total_count' => $item->total_count + 0.1,
                'cleaning_count' => $item->cleaning_count + 0.1,
                'installation_count' => $item->installation_count + 0.1,
                'maintenance_count' => $item->maintenance_count + 0.1,
                'repair_count' => $item->repair_count + 0.1,
            ];
        });

        $monthly_bookings = DB::table('services')
            ->select(DB::raw('DATE_FORMAT(service_date, "%Y-%m") as date'), 
                DB::raw('SUM(CASE WHEN service_type = "cleaning" THEN 1 ELSE 0 END) as cleaning_count'), 
                DB::raw('SUM(CASE WHEN service_type = "installation" THEN 1 ELSE 0 END) as installation_count'), 
                DB::raw('SUM(CASE WHEN service_type = "maintenance" THEN 1 ELSE 0 END) as maintenance_count'), 
                DB::raw('SUM(CASE WHEN service_type = "repair" THEN 1 ELSE 0 END) as repair_count'),
                DB::raw('COUNT(*) as total_count'))
            ->whereNotNull('service_date')
            ->groupBy(DB::raw('DATE_FORMAT(service_date, "%Y-%m")'))
            ->orderBy(DB::raw('YEAR(service_date)'))
            ->orderBy(DB::raw('MONTH(service_date)'))
            ->get();

        $formatted_monthly_bookings = $monthly_bookings->map(function($item) {
            $month_date = Carbon::createFromFormat('Y-m', $item->date);
            return [
                'month' => $month_date->format('M Y'),
                'total_count' => $item->total_count + 0.1,
                'cleaning_count' => $item->cleaning_count + 0.1,
                'installation_count' => $item->installation_count + 0.1,
                'maintenance_count' => $item->maintenance_count + 0.1,
                'repair_count' => $item->repair_count + 0.1,
            ];
        });

        $yearly_bookings = DB::table('services')
            ->select(
                DB::raw('YEAR(service_date) as year'),
                DB::raw('SUM(CASE WHEN service_type = "cleaning" THEN 1 ELSE 0 END) as cleaning_count'),
                DB::raw('SUM(CASE WHEN service_type = "installation" THEN 1 ELSE 0 END) as installation_count'),
                DB::raw('SUM(CASE WHEN service_type = "maintenance" THEN 1 ELSE 0 END) as maintenance_count'),
                DB::raw('SUM(CASE WHEN service_type = "repair" THEN 1 ELSE 0 END) as repair_count'),
                DB::raw('COUNT(*) as total_count'))
            ->whereNotNull('service_date')
            ->whereIn('service_type', ['cleaning', 'installation', 'maintenance', 'repair'])
            ->groupBy(DB::raw('YEAR(service_date)'))
            ->orderBy(DB::raw('YEAR(service_date)'))
            ->get();

        $formatted_yearly_bookings = $yearly_bookings->map(function($item) {
            return [
                'year' => $item->year,
                'total_count' => $item->total_count + 0.1,
                'cleaning_count' => $item->cleaning_count + 0.1,
                'installation_count' => $item->installation_count + 0.1,
                'maintenance_count' => $item->maintenance_count + 0.1,
                'repair_count' => $item->repair_count + 0.1,
            ];
        });

        $data = [
            'daily_bookings' => $formatted_daily_bookings,
            'weekly_bookings' => $formatted_weekly_bookings,
            'monthly_bookings' => $formatted_monthly_bookings,
            'yearly_bookings' => $formatted_yearly_bookings,
        ];

        return response($data, 200);
    }

    public function multiPayments()
    {
        $daily_payments = DB::table('transactions')
            ->leftJoin('services', 'services.id', '=', 'transactions.service_id')
            ->select(DB::raw('DATE_FORMAT(service_date, "%Y-%m-%d") as day'), 
                DB::raw('COUNT(*) as total_count'), 
                DB::raw('SUM(CASE WHEN service_type = "cleaning" THEN transactions.amount ELSE 0 END) as cleaning_amount'), 
                DB::raw('SUM(CASE WHEN service_type = "installation" THEN transactions.amount ELSE 0 END) as installation_amount'), 
                DB::raw('SUM(CASE WHEN service_type = "maintenance" THEN transactions.amount ELSE 0 END) as maintenance_amount'), 
                DB::raw('SUM(CASE WHEN service_type = "repair" THEN transactions.amount ELSE 0 END) as repair_amount'), 
                DB::raw('SUM(transactions.amount) as total_amount'))
            ->whereNotNull('service_date')
            ->whereDate('service_date', Carbon::now()->toDateString())
            ->whereIn('service_type', ['cleaning', 'installation', 'maintenance', 'repair'])
            ->groupBy(DB::raw('DATE_FORMAT(service_date, "%Y-%m-%d")'))
            ->orderBy(DB::raw('service_date'))
            ->get();
        $formatted_daily_payments = $daily_payments->map(function($item) {
            $day_date = Carbon::createFromFormat('Y-m-d', $item->day);
            return [
                'day' => $day_date->format('d M Y'),
                'cleaning_amount' => $item->cleaning_amount + 0.1,
                'installation_amount' => $item->installation_amount + 0.1,
                'maintenance_amount' => $item->maintenance_amount + 0.1,
                'repair_amount' => $item->repair_amount + 0.1,
                'total_amount' => $item->total_amount + 0.1,
            ];
        });

        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $weekly_payments = DB::table('transactions')
            ->join('services', 'transactions.service_id', '=', 'services.id')
            ->select(DB::raw('DATE_FORMAT(service_date, "%Y-%m-%d") as day'), 
                DB::raw('SUM(CASE WHEN services.service_type = "cleaning" THEN transactions.amount ELSE 0 END) as cleaning_amount'), 
                DB::raw('SUM(CASE WHEN services.service_type = "installation" THEN transactions.amount ELSE 0 END) as installation_amount'), 
                DB::raw('SUM(CASE WHEN services.service_type = "maintenance" THEN transactions.amount ELSE 0 END) as maintenance_amount'), 
                DB::raw('SUM(CASE WHEN services.service_type = "repair" THEN transactions.amount ELSE 0 END) as repair_amount'),
                DB::raw('SUM(transactions.amount) as total_amount'))
            ->whereNotNull('service_date')
            ->whereIn('services.service_type', ['cleaning', 'installation', 'maintenance', 'repair'])
            ->whereBetween('service_date', [$startOfWeek->toDateString(), $endOfWeek->toDateString()])
            ->groupBy(DB::raw('DATE_FORMAT(service_date, "%Y-%m-%d")'))
            ->orderBy(DB::raw('service_date'));
        $formatted_weekly_payments = $weekly_payments->get();
        $formatted_weekly_payments = $formatted_weekly_payments->map(function($item) {
            $day_date = Carbon::createFromFormat('Y-m-d', $item->day);
            return [
                'day' => $day_date->format('D d M Y'),
                'cleaning_amount' => $item->cleaning_amount + 0.1,
                'installation_amount' => $item->installation_amount + 0.1,
                'maintenance_amount' => $item->maintenance_amount + 0.1,
                'repair_amount' => $item->repair_amount + 0.1,
                'total_amount' => $item->total_amount + 0.1,
            ];
        });

        $monthly_payments = DB::table('transactions')
            ->join('services', 'transactions.service_id', '=', 'services.id')
            ->select(DB::raw('DATE_FORMAT(service_date, "%Y-%m") as date'),
                DB::raw('SUM(CASE WHEN services.service_type = "cleaning" THEN transactions.amount ELSE 0 END) as cleaning_amount'), 
                DB::raw('SUM(CASE WHEN services.service_type = "installation" THEN transactions.amount ELSE 0 END) as installation_amount'), 
                DB::raw('SUM(CASE WHEN services.service_type = "maintenance" THEN transactions.amount ELSE 0 END) as maintenance_amount'), 
                DB::raw('SUM(CASE WHEN services.service_type = "repair" THEN transactions.amount ELSE 0 END) as repair_amount'),
                DB::raw('SUM(transactions.amount) as total_amount'))
            ->whereNotNull('service_date')
            ->groupBy(DB::raw('DATE_FORMAT(service_date, "%Y-%m")'))
            ->orderBy(DB::raw('YEAR(service_date)'))
            ->orderBy(DB::raw('MONTH(service_date)'))
            ->get();

        $formatted_monthly_payments = $monthly_payments->map(function($item) {
            $month_date = Carbon::createFromFormat('Y-m', $item->date);
            return [
                'month' => $month_date->format('M Y'),
                'total_amount' => $item->total_amount + 0.1,
                'cleaning_amount' => $item->cleaning_amount + 0.1,
                'installation_amount' => $item->installation_amount + 0.1,
                'maintenance_amount' => $item->maintenance_amount + 0.1,
                'repair_amount' => $item->repair_amount + 0.1,
            ];
        });

        $yearly_payments = DB::table('transactions')
            ->join('services', 'transactions.service_id', '=', 'services.id')
            ->select(
                DB::raw('YEAR(service_date) as year'),
                DB::raw('SUM(CASE WHEN services.service_type = "cleaning" THEN transactions.amount ELSE 0 END) as cleaning_amount'),
                DB::raw('SUM(CASE WHEN services.service_type = "installation" THEN transactions.amount ELSE 0 END) as installation_amount'),
                DB::raw('SUM(CASE WHEN services.service_type = "maintenance" THEN transactions.amount ELSE 0 END) as maintenance_amount'),
                DB::raw('SUM(CASE WHEN services.service_type = "repair" THEN transactions.amount ELSE 0 END) as repair_amount'),
                DB::raw('SUM(transactions.amount) as total_amount'))
            ->whereNotNull('service_date')
            ->whereIn('services.service_type', ['cleaning', 'installation', 'maintenance', 'repair'])
            ->groupBy(DB::raw('YEAR(service_date)'))
            ->orderBy(DB::raw('YEAR(service_date)'))
            ->get();

        $formatted_yearly_payments = $yearly_payments->map(function($item) {
            return [
                'year' => $item->year,
                'total_amount' => $item->total_amount + 0.1,
                'cleaning_amount' => $item->cleaning_amount + 0.1,
                'installation_amount' => $item->installation_amount + 0.1,
                'maintenance_amount' => $item->maintenance_amount + 0.1,
                'repair_amount' => $item->repair_amount + 0.1,
            ];
        });


        $data = [
            'daily_payments' => $formatted_daily_payments,
            'weekly_payments' => $formatted_weekly_payments,
            'monthly_payments' => $formatted_monthly_payments,
            'yearly_payments' => $formatted_yearly_payments,
        ];

        return response($data, 200);
    }

    public function multiStatuses()
    {
        $transactionCancelledCount = DB::table('transactions')->where('transaction_status', 'cancelled')->count();
        $transactioProcessingCount = DB::table('transactions')->where('transaction_status', 'processing')->count();
        $transactionFailedCount = DB::table('transactions')->where('transaction_status', 'failed')->count();
        $transactionPendingCount = DB::table('transactions')->where('transaction_status', 'pending')->count();
        $transactionSuccessCount = DB::table('transactions')->where('transaction_status', 'success')->count();

        $serviceCancelledCount = DB::table('services')->where('service_status', 'cancelled')->count();$serviceCheckingCount = DB::table('services')->where('service_status', 'checking')->count();$servicePendingCount = DB::table('services')->where('service_status', 'pending')->count();
        $serviceFollowUpCount = DB::table('services')
            ->leftJoin('followup_services', 'services.id', '=', 'followup_services.service_id')
            ->where('services.service_status', 'followup')
            ->where('followup_services.followup_status', 'pending')
            ->count();
        $serviceFinishedCount = DB::table('services')
            ->leftJoin('followup_services', 'services.id', '=', 'followup_services.service_id')
            ->where(function ($query) {
                $query->where('services.service_status', 'finished')
                    ->orWhere('followup_services.followup_status', 'finished');
            })
            ->count();
        $serviceCompletedCount = DB::table('services')
            ->leftJoin('followup_services', 'services.id', '=', 'followup_services.service_id')
            ->where(function ($query) {
                $query->where('services.service_status', 'completed')
                    ->orWhere('followup_services.followup_status', 'completed');
            })
            ->count();

        $statusCounts = [
            'transaction_cancelled_count' => $transactionCancelledCount,
            'transaction_pending_count' => $transactionPendingCount,
            'transaction_processing_count' => $transactioProcessingCount,
            'transaction_failed_count' => $transactionFailedCount,
            'transaction_success_count' => $transactionSuccessCount,
            'service_cancelled_count' => $serviceCancelledCount,
            'service_checking_count' => $serviceCheckingCount,    
            'service_pending_count' => $servicePendingCount,
            'service_followup_count' => $serviceFollowUpCount,
            'service_finished_count' => $serviceFinishedCount,
            'service_completed_count' => $serviceCompletedCount,        
        ];

        return response($statusCounts, 200);
    }

    public function multiTables()
    {
        $transactionCancelledTable = DB::table('transactions')
            ->leftJoin('services', 'services.id', '=', 'transactions.service_id')
            ->leftJoin('voucher_transactions', 'transactions.id', '=', 'voucher_transactions.transaction_id')
            ->leftJoin('vouchers', 'voucher_transactions.voucher_id', '=', 'vouchers.id')
            ->where('transactions.transaction_status', 'cancelled')
            ->select('transactions.*', 'services.service_price', 'vouchers.id as voucher_id', 'vouchers.discount')
            ->get();
        $transactionProcessingTable = DB::table('transactions')
            ->leftJoin('services', 'services.id', '=', 'transactions.service_id')
            ->leftJoin('voucher_transactions', 'transactions.id', '=', 'voucher_transactions.transaction_id')
            ->leftJoin('vouchers', 'voucher_transactions.voucher_id', '=', 'vouchers.id')
            ->where('transactions.transaction_status', 'processing')
            ->select('transactions.*', 'services.service_price', 'vouchers.id as voucher_id', 'vouchers.discount')
            ->get();
        $transactionFailedTable = DB::table('transactions')
            ->leftJoin('services', 'services.id', '=', 'transactions.service_id')
            ->leftJoin('voucher_transactions', 'transactions.id', '=', 'voucher_transactions.transaction_id')
            ->leftJoin('vouchers', 'voucher_transactions.voucher_id', '=', 'vouchers.id')
            ->where('transactions.transaction_status', 'failed')
            ->select('transactions.*', 'services.service_price', 'vouchers.id as voucher_id', 'vouchers.discount')
            ->get();
        $transactionPendingTable = DB::table('transactions')
            ->leftJoin('services', 'services.id', '=', 'transactions.service_id')
            ->leftJoin('voucher_transactions', 'transactions.id', '=', 'voucher_transactions.transaction_id')
            ->leftJoin('vouchers', 'voucher_transactions.voucher_id', '=', 'vouchers.id')
            ->where('transactions.transaction_status', 'pending')
            ->select('transactions.*', 'services.service_price', 'vouchers.id as voucher_id', 'vouchers.discount')
            ->get();
        $transactionSuccessTable = DB::table('transactions')
            ->leftJoin('services', 'services.id', '=', 'transactions.service_id')
            ->leftJoin('voucher_transactions', 'transactions.id', '=', 'voucher_transactions.transaction_id')
            ->leftJoin('vouchers', 'voucher_transactions.voucher_id', '=', 'vouchers.id')
            ->where('transactions.transaction_status', 'success')
            ->select('transactions.*', 'services.service_price', 'vouchers.id as voucher_id', 'vouchers.discount')
            ->get();

        $serviceCancelledTable = DB::table('services')->where('service_status', 'cancelled')->get();
        $serviceCheckingTable = DB::table('services')->where('service_status', 'checking')->get();
        $servicePendingTable = DB::table('services')->where('service_status', 'pending')->get();

        $serviceFollowUpTable = DB::table('services')
            ->leftJoin('followup_services', 'services.id', '=', 'followup_services.service_id')
            ->where('services.service_status', 'followup')
            ->where('followup_services.followup_status', 'pending')
            ->select('services.*', 'followup_services.id as followup_id', 'followup_services.reason', 'followup_services.followup_date', 'followup_services.followup_time', 'followup_services.followup_status')
            ->get();

        $serviceFinishedTable = DB::table('services')
            ->leftJoin('followup_services', 'services.id', '=', 'followup_services.service_id')
            ->where(function ($query) {
                $query->where('services.service_status', 'finished')
                    ->orWhere('followup_services.followup_status', 'finished');
            })
            ->select('services.*', 'followup_services.id as followup_id', 'followup_services.reason', 'followup_services.followup_date', 'followup_services.followup_time', 'followup_services.followup_report', 'followup_services.followup_status')
            ->get();

        $serviceCompletedTable = DB::table('services')
            ->leftJoin('followup_services', 'services.id', '=', 'followup_services.service_id')
            ->where(function ($query) {
                $query->where('services.service_status', 'completed')
                    ->orWhere('followup_services.followup_status', 'completed');
            })
            ->select('services.*', 'followup_services.id as followup_id', 'followup_services.reason', 'followup_services.followup_date', 'followup_services.followup_time', 'followup_services.followup_report', 'followup_services.followup_status')
            ->get();
        
        $dataTables = [
            'transaction_cancelled_table' => $transactionCancelledTable,
            'transaction_pending_table' => $transactionPendingTable,
            'transaction_processing_table' => $transactionProcessingTable,
            'transaction_failed_table' => $transactionFailedTable,
            'transaction_success_table' => $transactionSuccessTable,
            'service_cancelled_table' => $serviceCancelledTable,
            'service_checking_table' => $serviceCheckingTable,    
            'service_pending_table' => $servicePendingTable,
            'service_followup_table' => $serviceFollowUpTable,
            'service_finished_table' => $serviceFinishedTable,
            'service_completed_table' => $serviceCompletedTable,        
        ];

        return response($dataTables, 200);
    }

    public function bookingsServiceType()
    {
        $bookings_service_type = DB::table('services')
            ->select('service_type', DB::raw('COUNT(*) as count'))
            ->groupBy('service_type')
            ->get();

        $formatted_data = $bookings_service_type->map(function($item) {
            return [
                'service_type' => $item->service_type,
                'value' => $item->count,
            ];
        });
    
        return response($formatted_data, 200);
    }

    public function bookingsBarangay()
    {
        $bookings_barangay = DB::table('services')
            ->leftJoin('customers', 'customers.id', '=', 'services.customer_id')
            ->select('barangay', DB::raw('COUNT(DISTINCT services.customer_id) as count'))
            ->whereNotNull('barangay')
            ->groupBy('customers.barangay')
            ->get();

        $formatted_data = $bookings_barangay->map(function($item) {
            return [
                'barangay' => $item->barangay,
                'value' => $item->count,
            ];
        });

        return response($formatted_data, 200);
    }

    public function inventoryReport()
    {
        $inventory_count = DB::table('technician_inventories')
            ->join('inventories', 'inventories.id', '=', 'technician_inventories.inventory_id')
            ->select('inventories.name', DB::raw('COUNT(*) as count'))
            ->groupBy('inventories.name')
            ->get();

        $formatted_data = $inventory_count->map(function($item) {
            return [            
                'name' => $item->name,            
                'count' => $item->count,        
            ];
        });

        return response($formatted_data, 200);
    }

    public function technicianServices()
    {
        $technician_services = DB::table('technician_services')
            ->join('technicians', 'technician_services.technician_id', '=', 'technicians.id')
            ->select('technicians.last_name', DB::raw('COUNT(technician_services.service_id) as count'))
            ->groupBy('technicians.last_name')
            ->get();

        $formatted_data = $technician_services->map(function($item) {
            return [
                'technician' => $item->last_name,
                'count' => $item->count,
            ];
        });

        return response($formatted_data, 200);
    }

    public function walkinService()
    {
        $services = DB::table('services')
            ->leftJoin('technician_services', 'services.id', '=', 'technician_services.service_id')
            ->leftJoin('technicians', 'technician_services.technician_id', '=', 'technicians.id')
            ->leftJoin('customers', 'services.customer_id', '=', 'customers.id')
            ->leftJoin('admins', 'services.admin_id', '=', 'admins.id')
            ->leftJoin('users', 'customers.user_id', '=', 'users.id')
            ->where('services.book_type', '=', 'walk-in')
            ->select('services.*', 'customers.last_name as customer_last_name', 
                'admins.last_name as admin_last_name',
                DB::raw('CONCAT(customers.property_type, ", ", customers.address, ", ", customers.barangay, ", ", customers.city, ", ", customers.province, ", ", customers.zip_code) as full_address'),
                DB::raw('GROUP_CONCAT(technicians.last_name SEPARATOR ", ") as technician_last_names'))
            ->groupBy('services.id')
            ->orderByDesc('services.id')
            ->get();

        return response($services, 200);
    }

    public function allSchedule()
    {
        $service_schedule = DB::table('services')
            ->select('service_date as date', 'service_time as time')
            ->whereNotNull('service_date')
            ->whereNotNull('service_time')
            ->get();

        $followup_schedule = DB::table('followup_services')
            ->select('followup_date as date', 'followup_time as time')
            ->whereNotNull('followup_date')
            ->whereNotNull('followup_time')
            ->get();

        $all_schedule = $service_schedule->concat($followup_schedule)
            ->map(function($schedule) {
                return [
                    'date' => $schedule->date,
                    'time' => $schedule->time
                ];
            });

        return response()->json($all_schedule);
    }

    public function allFeedback()
    {
        $service_feedbacks = DB::table('feedbacks')
            ->join('services', 'services.id', '=', 'feedbacks.service_id')
            ->leftJoin('followup_services', 'followup_services.service_id', '=', 'services.id')
            ->leftJoin('customers', 'services.customer_id', '=', 'customers.id')
            ->leftJoin('technician_services', 'services.id', '=', 'technician_services.service_id')
            ->leftJoin('technicians', 'technician_services.technician_id', '=', 'technicians.id')
            ->leftJoin('admins', 'services.admin_id', '=', 'admins.id')
            ->where(function ($query) {
                $query->where('services.service_status', 'completed')
                    ->orWhere(function ($query) {
                        $query->where('followup_services.followup_status', 'completed')
                            ->where('followup_services.service_id', '!=', null);
                    });
            })
            ->select('feedbacks.*', 
                DB::raw('CONCAT(customers.first_name, " ", customers.last_name) as customer_full_name'), 
                'admins.last_name as admin_last_name', 
                DB::raw('GROUP_CONCAT(technicians.last_name SEPARATOR ", ") as technician_last_names'))
            ->groupBy('feedbacks.id')
            ->orderByDesc('feedbacks.id')
            ->get();

        return response($service_feedbacks, 200);
    }

    public function allPostConsultation()
    {
        $post_consultations = DB::table('post_consultations')
            ->join('services', 'services.id', '=', 'post_consultations.service_id')
            ->leftJoin('followup_services', 'followup_services.service_id', '=', 'services.id')
            ->leftJoin('customers', 'services.customer_id', '=', 'customers.id')
            ->leftJoin('technician_services', 'services.id', '=', 'technician_services.service_id')
            ->leftJoin('technicians', 'technician_services.technician_id', '=', 'technicians.id')
            ->leftJoin('admins', 'services.admin_id', '=', 'admins.id')
            ->where(function ($query) {
                $query->where('services.service_status', 'completed')
                    ->orWhere(function ($query) {
                        $query->where('followup_services.followup_status', 'completed')
                            ->where('followup_services.service_id', '!=', null);
                    });
            })
            ->select('post_consultations.*',
                    DB::raw('CONCAT(customers.first_name, " ", customers.last_name) as customer_full_name'), 
                    'admins.last_name as admin_last_name', 
                    DB::raw('GROUP_CONCAT(technicians.last_name SEPARATOR ", ") as technician_last_names'))
            ->groupBy('post_consultations.id')
            ->orderByDesc('post_consultations.id')
            ->get();

        return response($post_consultations, 200);
    }

    public function allVoucher()
    {
        $vouchers = DB::table('vouchers')
            ->get();

        return response($vouchers, 200);
    }

    public function attendanceLogs()
    {
        $attendances = DB::table('attendances')
            ->join('technicians', 'attendances.technician_id', '=', 'technicians.id')
            ->select('attendances.*', 'technicians.id as technician_id', DB::raw('CONCAT(technicians.first_name, " ", technicians.last_name) AS full_name'))
            ->orderByDesc('attendances.id')
            ->get();

        return response($attendances, 200);
    }

    public function allInventory()
    {
        $inventories = DB::table('inventories')
            ->orderByDesc('inventories.id')
            ->get();

        return response($inventories, 200);
    }

    public function inventoryLogs()
    {
        $technician_inventories = DB::table('technician_inventories')
            ->join('inventories', 'technician_inventories.inventory_id', '=', 'inventories.id')
            ->join('technicians', 'technician_inventories.technician_id', '=', 'technicians.id')
            ->select('inventories.*', 'technician_inventories.id as log_id', 'technician_inventories.quantity', 'technician_inventories.borrowed_date', 'technician_inventories.returned_date', 'technicians.id AS technician_id', DB::raw('CONCAT(technicians.first_name, " ", technicians.last_name) AS full_name'))
            ->orderByDesc('log_id')
            ->get();

        return response($technician_inventories, 200);
    }

    public function allSuperAdmin()
    {
        $super_admins = DB::table('super_admins')
            ->join('users', 'super_admins.user_id', '=', 'users.id')
            ->select('super_admins.*', 'users.phone_number', 'users.email')
            ->orderByDesc('super_admins.id')
            ->get();

        return response($super_admins, 200);
    }

    public function allAdmin()
    {
        $admins = DB::table('admins')
            ->join('users', 'admins.user_id', '=', 'users.id')
            ->select('admins.*', 'users.phone_number', 'users.email')
            ->orderByDesc('admins.id')
            ->get();

        return response($admins, 200);
    }

    public function allTechnician()
    {
        $technicians = DB::table('technicians')
            ->join('users', 'technicians.user_id', '=', 'users.id')
            ->select('technicians.*', 'users.phone_number', 'users.email', 'users.role')
            ->orderByDesc('technicians.id')
            ->get();

        return response($technicians, 200);
    }

    public function allCustomer()
    {
        $customers = DB::table('customers')
            ->leftJoin('users', 'customers.user_id', '=', 'users.id')
            ->select('customers.*', 'users.phone_number', 'users.email')
            ->orderByDesc('customers.id')
            ->get();

        return response($customers, 200);
    }

    public function allUser()
    {
        $users = DB::table('users')
            ->leftJoin('admins', 'users.id', '=', 'admins.user_id')
            ->leftJoin('technicians', 'users.id', '=', 'technicians.user_id')
            ->leftJoin('customers', 'users.id', '=', 'customers.user_id')
            ->leftJoin('super_admins', 'users.id', '=', 'super_admins.user_id')
            ->select('users.*', DB::raw('(CASE
                WHEN admins.id IS NOT NULL THEN admins.id
                WHEN technicians.id IS NOT NULL THEN technicians.id
                WHEN customers.id IS NOT NULL THEN customers.id
                WHEN super_admins.id IS NOT NULL THEN super_admins.id
                ELSE NULL
                END) AS role_id'))
                ->selectRaw('CASE
                WHEN admins.id IS NOT NULL THEN "admin"
                WHEN technicians.id IS NOT NULL THEN "technician"
                WHEN customers.id IS NOT NULL THEN "customer"
                WHEN super_admins.id IS NOT NULL THEN "super admin"
                ELSE NULL
                END AS role')
            ->orderByDesc('users.id')
            ->get();

        return response($users, 200);
    }
}
