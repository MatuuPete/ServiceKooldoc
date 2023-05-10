<?php

use App\Http\Controllers\NewPasswordController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () { return view('auth.login'); })->name('login');
Route::get('/register', function () { return view('auth.register'); })->name('register');

Route::get('/forgot-password', [NewPasswordController::class, 'showForgotForm'])->name('password.email');
Route::get('reset-password/{token}', [NewPasswordController::class, 'showResetForm'])->name('password.reset');

Route::get('/mission-vision', function () { return view('mission_vision'); });
Route::get('/company-product-history', function () { return view('company_product_history'); });
Route::get('/key-products', function () { return view('key_products'); });
Route::get('/pricing-quotation', function () { return view('pricing_quotation'); });
Route::get('/ac-info', function () { return view('ac_info'); });
Route::get('/future-plan', function () { return view('future_plan'); });
Route::get('/terms-conditions', function () { return view('terms_conditions'); });
Route::get('/privacy-policy', function () { return view('privacy_policy'); });
Route::get('/map-location', function () { return view('map_location'); });
Route::get('/mobile-app', function () { return view('mobile_app'); });
Route::get('/book-service', function () { return view('book_service'); });
Route::get('/walkin-book', function () { return view('walkin_book'); });
Route::get('/booking-successful', function () { return view('booking_successful'); });
Route::get('/walkin-successful', function () { return view('walkin_successful'); });

// Route::prefix('super-admin')->middleware(['auth', 'user-role:super admin',])->group(function(){
    Route::get('/super-admin-profile', function () { return view('auth.super_admin_profile'); });
    Route::get('/dashboard', function () { return view('super_admin.dashboard'); });
    Route::get('/transaction-cancelled', function () { return view('super_admin.transaction_cancelled'); });
    Route::get('/transaction-pending', function () { return view('super_admin.transaction_pending'); });
    Route::get('/transaction-processing', function () { return view('super_admin.transaction_processing'); });
    Route::get('/transaction-failed', function () { return view('super_admin.transaction_failed'); });
    Route::get('/transaction-success', function () { return view('super_admin.transaction_success'); });
    Route::get('/service-cancelled', function () { return view('super_admin.service_cancelled'); });
    Route::get('/service-checking', function () { return view('super_admin.service_checking'); });
    Route::get('/service-pending', function () { return view('super_admin.service_pending'); });
    Route::get('/service-followup', function () { return view('super_admin.service_followup'); });
    Route::get('/service-finished', function () { return view('super_admin.service_finished'); });
    Route::get('/service-completed', function () { return view('super_admin.service_completed'); });
    Route::get('/walkin-service', function () { return view('super_admin.walkin_service'); });
    Route::get('/all-feedback', function () { return view('super_admin.all_feedback'); });
    Route::get('/all-post-consultation', function () { return view('super_admin.all_post_consultation'); });
    Route::get('/all-voucher', function () { return view('super_admin.all_voucher'); });
    Route::get('/attendance-logs', function () { return view('super_admin.attendance_logs'); });
    Route::get('/all-inventory', function () { return view('super_admin.all_inventory'); });
    Route::get('/inventory-logs', function () { return view('super_admin.inventory_logs'); });
    Route::get('/all-super-admin', function () { return view('super_admin.all_super_admin'); });
    Route::get('/all-admin', function () { return view('super_admin.all_admin'); });
    Route::get('/all-technician', function () { return view('super_admin.all_technician'); });
    Route::get('/all-customer', function () { return view('super_admin.all_customer'); });
    Route::get('/all-user', function () { return view('super_admin.all_user'); });
// });

// Route::prefix('admin')->middleware(['auth', 'user-role:admin',])->group(function(){
    Route::get('/admin-profile', function () { return view('auth.admin_profile'); });
    Route::get('/all-services', function () { return view('admin.all_services'); });
    Route::get('/all-finished-service', function () { return view('admin.all_finished_service'); });
    Route::get('/all-completed-service', function () { return view('admin.all_completed_service'); });
    Route::get('/all-follow-up-service', function () { return view('admin.all_follow_up_service'); });
    Route::get('/all-finished-followup-service', function () { return view('admin.all_finished_followup_service'); });
    Route::get('/all-completed-followup-service', function () { return view('admin.all_completed_followup_service'); });
    Route::get('/all-cancelled-service', function () { return view('admin.all_cancelled_service'); });
    Route::get('/all-service-warranty', function () { return view('admin.all_service_warranty'); });
    Route::get('/all-warranty-claim', function () { return view('admin.all_warranty_claim'); });
    Route::get('/all-transaction', function () { return view('admin.all_transaction'); });
    Route::get('/all-cancelled-transaction', function () { return view('admin.all_cancelled_transaction'); });
    Route::get('/all-attendance', function () { return view('admin.all_attendance'); });
// });

// Route::prefix('technician')->middleware(['auth', 'user-role:technician'])->group(function(){
    Route::get('/technician-profile', function () { return view('auth.technician_profile'); });
    Route::get('/assigned-services', function () { return view('technician.assigned_services'); });
    Route::get('/finished-assigned-service', function () { return view('technician.finished_assigned_service'); });
    Route::get('/completed-assigned-service', function () { return view('technician.completed_assigned_service'); });
    Route::get('/follow-up-assigned-service', function () { return view('technician.follow_up_assigned_service'); });
    Route::get('/finished-followup-assigned-service', function () { return view('technician.finished_followup_assigned_service'); });
    Route::get('/completed-followup-assigned-service', function () { return view('technician.completed_followup_assigned_service'); });
    Route::get('/technician-attendance', function () { return view('technician.attendance'); });
    Route::get('/borrow-inventory', function () { return view('technician.borrow_inventory'); });
    Route::get('/return-inventory', function () { return view('technician.return_inventory'); });
// });

// Route::prefix('customer')->middleware(['auth', 'user-role:customer'])->group(function(){
    Route::get('/customer-profile', function () { return view('auth.customer_profile'); });
    Route::get('/booked-services', function () { return view('customer.booked_services'); });
    Route::get('/finished-booked-service', function () { return view('customer.finished_booked_service'); });
    Route::get('/completed-booked-service', function () { return view('customer.completed_booked_service'); });
    Route::get('/follow-up-booked-service', function () { return view('customer.follow_up_booked_service'); });
    Route::get('/finished-followup-booked-service', function () { return view('customer.finished_followup_booked_service'); });
    Route::get('/completed-followup-booked-service', function () { return view('customer.completed_followup_booked_service'); });
    Route::get('/cancelled-service', function () { return view('customer.cancelled_service'); });
    Route::get('/service-feedback', function () { return view('customer.service_feedback'); });
    Route::get('/service-post-consultation', function () { return view('customer.service_post_consultation'); });
    Route::get('/service-warranty', function () { return view('customer.service_warranty'); });
    Route::get('/warranty-claim', function () { return view('customer.warranty_claim'); });
    Route::get('/transaction-histories', function () { return view('customer.transaction_histories'); });
    Route::get('/cancelled-transaction-history', function () { return view('customer.cancelled_transaction_history'); });
// });

Route::get('/link-storage', function () {Artisan::call('storage:link'); });
