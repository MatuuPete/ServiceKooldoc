<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminShowController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CancelController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerShowController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\FollowupServiceController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\MobileController;
use App\Http\Controllers\NewPasswordController;
use App\Http\Controllers\PostConsultationController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\SuperAdminShowController;
use App\Http\Controllers\TechnicianController;
use App\Http\Controllers\TechnicianInventoryController;
use App\Http\Controllers\TechnicianShowController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerifyEmailController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\WarrantyClaimController;
use App\Http\Controllers\WarrantyController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'api'], function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    
    Route::post('forgot-password', [NewPasswordController::class, 'forgotPassword']);
    Route::post('reset-password', [NewPasswordController::class, 'resetPassword']);

    Route::post('/email', [EmailController::class, 'sendEmail']);

    Route::post('/guest-services', [ServiceController::class, 'guestStore']);

    Route::get('/vouchers/all', [VoucherController::class, 'showAll']);
    Route::get('/vouchers/{id}', [VoucherController::class, 'show']);

    Route::get('/all-technician', [SuperAdminShowController::class, 'allTechnician']);
    Route::get('/all-admin', [SuperAdminShowController::class, 'allAdmin']);
    Route::get('/all-feedback', [SuperAdminShowController::class, 'allFeedback']);   
    Route::get('/all-schedule', [SuperAdminShowController::class, 'allSchedule']); 

    Route::post('/mobile-register', [MobileController::class, 'mobileRegister']);
    Route::post('/mobile-login', [MobileController::class, 'mobileLogin']);
    Route::post('/mobile-logout', [MobileController::class, 'mobileLogout']);

    Route::get('/customer-profile/{id}', [MobileController::class, 'customerProfile']);
    Route::get('/technician-profile/{id}', [MobileController::class, 'technicianProfile']);

    Route::put('/customer-change-password/{id}', [MobileController::class, 'customerChangePassword']);
    Route::put('/technician-change-password/{id}', [MobileController::class, 'technicianChangePassword']);

    Route::put('/customer-update/{id}', [MobileController::class, 'customerUpdate']);
    Route::put('/technician-update/{id}', [MobileController::class, 'technicianUpdate']);

    Route::post('/custimage/{id}', [MobileController::class, 'customerImage']);
    Route::post('/technician-image/{id}', [MobileController::class, 'technicianImage']);

    Route::post('/mobile-book', [MobileController::class, 'mobileBook']);
    Route::post('/followup-book/{id}', [MobileController::class, 'followupBook']);
    
    Route::get('/customer-booked-services/{id}', [MobileController::class, 'customerBookedServices']);
    Route::get('/customer-followup-services/{id}', [MobileController::class, 'customerFollowupServices']);
    Route::get('/customer-finished-services/{id}', [MobileController::class, 'customerFinishedServices']);
    Route::get('/customer-completed-services/{id}', [MobileController::class, 'customerCompletedServices']);
    Route::get('/customer-cancelled-services/{id}', [MobileController::class, 'customerCancelledServices']);
    
    Route::get('/technician-assigned-services/{id}', [MobileController::class, 'technicianAssignedServices']);
    Route::get('/technician-followup-services/{id}', [MobileController::class, 'technicianFollowupServices']);
    Route::get('/technician-finished-services/{id}', [MobileController::class, 'technicianFinishedServices']);
    Route::get('/technician-completed-services/{id}', [MobileController::class, 'technicianCompletedServices']);

    Route::post('/customer-cancel-service/{id}', [MobileController::class, 'customerCancelService']);

    Route::get('/customer-transaction-history/{id}', [MobileController::class, 'customerTransactionHistory']);
    Route::get('/customer-cancelled-transaction/{id}', [MobileController::class, 'customerCancelledTransaction']);
    Route::post('/edit-transaction/{id}', [MobileController::class, 'editTransaction']);

    Route::post('/technician-service-report/{id}', [MobileController::class, 'technicianServiceReport']);
    Route::post('/technician-followup-report/{id}', [MobileController::class, 'technicianFollowupReport']);

    Route::get('/customer-feedback/{id}', [MobileController::class, 'customerFeedback']);
    Route::post('/add-feedback/{id}', [MobileController::class, 'addFeedback']);
    Route::put('/edit-feedback/{id}', [MobileController::class, 'editFeedback']);
});

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('/profile', [AuthController::class, 'profile']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::post('/email/verification-notification',[VerifyEmailController::class, 'sendEmailVerification']);
    Route::get('/verify-email/{id}/{hash}',[VerifyEmailController::class, 'verify'])->name('verification.verify');

    Route::post('/admins', [AdminController::class, 'store']);
    Route::get('/admins/{id}', [AdminController::class, 'show']);
    Route::post('/admins/{id}', [AdminController::class, 'update']);
    Route::delete('/admins/{id}', [AdminController::class, 'destroy']);
    
    Route::post('/attendances', [AttendanceController::class, 'store']);
    Route::get('/attendances/{id}', [AttendanceController::class, 'show']);
    Route::put('/attendances/{id}', [AttendanceController::class, 'update']);
    Route::delete('/attendances/{id}', [AttendanceController::class, 'destroy']);
    
    Route::post('/cancel-services/{id}', [CancelController::class, 'store']);
    Route::get('/cancel-services/{id}', [CancelController::class, 'show']);
    
    Route::post('/customers', [CustomerController::class, 'store']);
    Route::get('/customers/{id}', [CustomerController::class, 'show']);
    Route::post('/customers/{id}', [CustomerController::class, 'update']);
    Route::delete('/customers/{id}', [CustomerController::class, 'destroy']);

    Route::post('/feedbacks', [FeedbackController::class, 'store']);
    Route::get('/feedbacks/{id}', [FeedbackController::class, 'show']);
    Route::put('/feedbacks/{id}', [FeedbackController::class, 'update']);
    Route::delete('/feedbacks/{id}', [FeedbackController::class, 'destroy']);
    
    Route::post('/followup-services', [FollowupServiceController::class, 'store']);
    Route::get('/followup-services/{id}', [FollowupServiceController::class, 'show']);
    Route::post('/followup-services/{id}', [FollowupServiceController::class, 'update']);

    Route::post('/inventories', [InventoryController::class, 'store']);
    Route::get('/inventories/{id}', [InventoryController::class, 'show']);
    Route::put('/inventories/{id}', [InventoryController::class, 'update']);
    Route::delete('/inventories/{id}', [InventoryController::class, 'destroy']);
    
    Route::post('/post-consultations', [PostConsultationController::class, 'store']);
    Route::get('/post-consultations/{id}', [PostConsultationController::class, 'show']);
    Route::put('/post-consultations/{id}', [PostConsultationController::class, 'update']);
    Route::delete('/post-consultations/{id}', [PostConsultationController::class, 'destroy']);
    
    Route::get('/services/search/{service_type}', [ServiceController::class, 'search']);
    Route::post('/services', [ServiceController::class, 'store']);
    Route::get('/services/{id}', [ServiceController::class, 'show']);
    Route::post('/services/{id}', [ServiceController::class, 'update']);
    Route::delete('/services/{id}', [ServiceController::class, 'destroy']);

    Route::post('/super-admins', [SuperAdminController::class, 'store']);
    Route::get('/super-admins/{id}', [SuperAdminController::class, 'show']);
    Route::post('/super-admins/{id}', [SuperAdminController::class, 'update']);
    Route::delete('/super-admins/{id}', [SuperAdminController::class, 'destroy']);

    Route::post('/technicians', [TechnicianController::class, 'store']);
    Route::get('/technicians/{id}', [TechnicianController::class, 'show']);
    Route::post('/technicians/{id}', [TechnicianController::class, 'update']);
    Route::delete('/technicians/{id}', [TechnicianController::class, 'destroy']);

    Route::post('/technician-inventories/{id}', [TechnicianInventoryController::class, 'assignInventory']);
    Route::put('/technician-inventories/{id}', [TechnicianInventoryController::class, 'unassignInventory']);

    Route::get('/transactions/{id}', [TransactionController::class, 'show']);
    Route::post('/transactions/{id}', [TransactionController::class, 'update']);

    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::put('/change-password', [UserController::class, 'changePassword']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);

    Route::post('/vouchers', [VoucherController::class, 'store']);
    Route::put('/vouchers/{id}', [VoucherController::class, 'update']);
    Route::delete('/vouchers/{id}', [VoucherController::class, 'destroy']);

    Route::post('/walkin-services', [ServiceController::class, 'walkinStore']);

    Route::post('/warranty-claims', [WarrantyClaimController::class, 'store']);
    Route::get('/warranty-claims/{id}', [WarrantyClaimController::class, 'show']);
    Route::put('/warranty-claims/{id}', [WarrantyClaimController::class, 'update']);
    Route::delete('/warranty-claims/{id}', [WarrantyClaimController::class, 'destroy']);

    Route::get('/warranties/{id}', [WarrantyController::class, 'show']);
    Route::put('/warranties/{id}', [WarrantyController::class, 'update']);
    Route::delete('/warranties/{id}', [WarrantyController::class, 'destroy']);
});

Route::group(['middleware' => ['auth:api', 'role:super admin']], function () {
    Route::get('/multi-bookings', [SuperAdminShowController::class, 'multiBookings']);
    Route::get('/multi-payments', [SuperAdminShowController::class, 'multiPayments']);
    Route::get('/multi-statuses', [SuperAdminShowController::class, 'multiStatuses']);
    Route::get('/multi-tables', [SuperAdminShowController::class, 'multiTables']);
    Route::get('/bookings-service-type', [SuperAdminShowController::class, 'bookingsServiceType']);
    Route::get('/bookings-barangay', [SuperAdminShowController::class, 'bookingsBarangay']);
    Route::get('/inventory-report', [SuperAdminShowController::class, 'inventoryReport']);
    Route::get('/technician-services', [SuperAdminShowController::class, 'technicianServices']);
    Route::get('/walkin-service', [SuperAdminShowController::class, 'walkinService']);
    Route::get('/all-post-consultation', [SuperAdminShowController::class, 'allPostConsultation']);
    Route::get('/all-voucher', [SuperAdminShowController::class, 'allVoucher']);
    Route::get('/attendance-logs', [SuperAdminShowController::class, 'attendanceLogs']);
    Route::get('/all-inventory', [SuperAdminShowController::class, 'allInventory']);
    Route::get('/inventory-logs', [SuperAdminShowController::class, 'inventoryLogs']);
    Route::get('/all-super-admin', [SuperAdminShowController::class, 'allSuperAdmin']);
    Route::get('/all-customer', [SuperAdminShowController::class, 'allCustomer']);
    Route::get('/all-user', [SuperAdminShowController::class, 'allUser']);
});

Route::group(['middleware' => ['auth:api', 'role:admin']], function () {
    Route::get('/all-services', [AdminShowController::class, 'allServices']);
    Route::get('/all-finished-service', [AdminShowController::class, 'allFinishedService']);
    Route::get('/all-completed-service', [AdminShowController::class, 'allCompletedService']);
    Route::get('/all-follow-up-service', [AdminShowController::class, 'allFollowUpService']);
    Route::get('/all-finished-followup-service', [AdminShowController::class, 'allFollowupFinishedService']);
    Route::get('/all-completed-followup-service', [AdminShowController::class, 'allFollowupCompletedService']);
    Route::get('/all-cancelled-service', [AdminShowController::class, 'allCancelledService']);
    Route::get('/all-service-warranty', [AdminShowController::class, 'allServiceWarranty']);
    Route::get('/all-warranty-claim', [AdminShowController::class, 'allWarrantyClaim']);
    Route::get('/all-transaction', [AdminShowController::class, 'allTransaction']);
    Route::get('/all-cancelled-transaction', [AdminShowController::class, 'allCancelledTransaction']);
    Route::get('/all-attendance', [AdminShowController::class, 'allAttendance']);
});

Route::group(['middleware' => ['auth:api', 'role:technician']], function () {
    Route::get('/assigned-services', [TechnicianShowController::class, 'assignedServices']);
    Route::get('/finished-assigned-service', [TechnicianShowController::class, 'finishedAssignedService']);
    Route::get('/completed-assigned-service', [TechnicianShowController::class, 'completedAssignedService']);
    Route::get('/follow-up-assigned-service', [TechnicianShowController::class, 'followUpAssignedService']);
    Route::get('/finished-followup-assigned-service', [TechnicianShowController::class, 'finishedFollowupAssignedService']);
    Route::get('/completed-followup-assigned-service', [TechnicianShowController::class, 'completedFollowupAssignedService']);
    Route::get('/technician-attendance', [TechnicianShowController::class, 'technicianAttendance']);
    Route::get('/borrow-inventory', [TechnicianShowController::class, 'borrowInventory']);
    Route::get('/return-inventory', [TechnicianShowController::class, 'returnInventory']);
});

Route::group(['middleware' => ['auth:api', 'role:customer']], function () {
    Route::get('/booked-services', [CustomerShowController::class, 'bookedServices']);
    Route::get('/finished-booked-service', [CustomerShowController::class, 'finishedBookedService']);
    Route::get('/completed-booked-service', [CustomerShowController::class, 'completedBookedService']);
    Route::get('/follow-up-booked-service', [CustomerShowController::class, 'followUpBookedService']);
    Route::get('/finished-followup-booked-service', [CustomerShowController::class, 'finishedFollowupBookedService']);
    Route::get('/completed-followup-booked-service', [CustomerShowController::class, 'completedFollowupBookedService']);
    Route::get('/cancelled-service', [CustomerShowController::class, 'cancelledService']);
    Route::get('/service-feedback', [CustomerShowController::class, 'serviceFeedback']);
    Route::get('/service-post-consultation', [CustomerShowController::class, 'servicePostConsultation']);
    Route::get('/service-warranty', [CustomerShowController::class, 'serviceWarranty']);
    Route::get('/warranty-claim', [CustomerShowController::class, 'warrantyClaim']);
    Route::get('/transaction-histories', [CustomerShowController::class, 'transactionHistories']);
    Route::get('/cancelled-transaction-history', [CustomerShowController::class, 'cancelledTransactionHistory']);
});