@extends('layouts.super_admin')

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="me-md-3 me-xl-5">
                        <h2>Welcome,</h2>
                        <p class="mb-md-0">Kooldoc improves lives.</p>
                    </div>
                    <div class="d-flex">
                        <i class="mdi mdi-home text-muted hover-cursor"></i>
                        <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</p>
                        <p class="text-primary mb-0 hover-cursor">Analytics</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body dashboard-tabs p-0">
                    <ul class="nav nav-tabs px-4" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="service-status-tab" data-bs-toggle="tab" href="#service-status" role="tab" aria-controls="service-status" aria-selected="true">Service Status</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="transaction-status-tab" data-bs-toggle="tab" href="#transaction-status" role="tab" aria-controls="transaction-status" aria-selected="false">Transaction Status</a>
                        </li>
                    </ul>
                    <div class="tab-content py-0 px-0">
                        <div class="tab-pane fade show active" id="service-status" role="tabpanel" aria-labelledby="service-status-tab">
                            <div class="d-flex flex-wrap justify-content-between">
                                <a class="text-decoration-none" href="/service-cancelled">
                                    <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                        <i class="mdi mdi-cancel me-3 icon-lg text-danger"></i>
                                        <div class="d-flex flex-column justify-content-around me-5">
                                            <small class="mb-1 text-muted">Cancelled</small>
                                            <h5 class="me-2 mb-0"><span id="service_cancelled_status"></span></h5>
                                        </div>
                                    </div>
                                </a>
                                <a class="text-decoration-none" href="/service-checking">
                                    <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                        <i class="mdi mdi-eye me-3 icon-lg text-primary"></i>
                                        <div class="d-flex flex-column justify-content-around me-5">
                                            <small class="mb-1 text-muted">Checking</small>
                                            <h5 class="me-2 mb-0"><span id="service_checking_status"></span></h5>
                                        </div>
                                    </div>
                                </a>
                                <a class="text-decoration-none" href="/service-pending">
                                    <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                        <i class="mdi mdi-book me-3 icon-lg text-primary"></i>
                                        <div class="d-flex flex-column justify-content-around me-5">
                                            <small class="mb-1 text-muted">Pending</small>
                                            <h5 class="me-2 mb-0"><span id="service_pending_status"></span></h5>
                                        </div>
                                    </div>
                                </a>
                                <a class="text-decoration-none" href="/service-followup">
                                    <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                        <i class="mdi mdi-update me-3 icon-lg text-warning"></i>
                                        <div class="d-flex flex-column justify-content-around me-5">
                                            <small class="mb-1 text-muted">Follow-up</small>
                                            <h5 class="me-2 mb-0"><span id="service_followup_status"></span></h5>
                                        </div>
                                    </div>
                                </a>
                                <a class="text-decoration-none" href="/service-finished">
                                    <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                        <i class="mdi mdi-check me-3 icon-lg text-success"></i>
                                        <div class="d-flex flex-column justify-content-around me-5">
                                            <small class="mb-1 text-muted">Finished</small>
                                            <h5 class="me-2 mb-0"><span id="service_finished_status"></span></h5>
                                        </div>
                                    </div>
                                </a>
                                <a class="text-decoration-none" href="/service-completed">
                                    <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                        <i class="mdi mdi-check-all me-3 icon-lg text-success"></i>
                                        <div class="d-flex flex-column justify-content-around me-5">
                                            <small class="mb-1 text-muted">Completed</small>
                                            <h5 class="me-2 mb-0"><span id="service_completed_status"></span></h5>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="transaction-status" role="tabpanel" aria-labelledby="transaction-status-tab">
                            <div class="d-flex flex-wrap justify-content-between">
                                <a class="text-decoration-none" href="/transaction-cancelled">
                                    <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                        <i class="mdi mdi-cancel me-3 icon-lg text-danger"></i>
                                        <div class="d-flex flex-column justify-content-around me-5">
                                            <small class="mb-1 text-muted">Cancelled</small>
                                            <h5 class="me-2 mb-0"><span id="transaction_cancelled_status"></span></h5>
                                        </div>
                                    </div>
                                </a>
                                <a class="text-decoration-none" href="/transaction-pending">
                                    <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                        <i class="mdi mdi-book me-3 icon-lg text-primary"></i>
                                        <div class="d-flex flex-column justify-content-around me-5">
                                            <small class="mb-1 text-muted">Pending</small>
                                            <h5 class="me-2 mb-0"><span id="transaction_pending_status"></span></h5>
                                        </div>
                                    </div>
                                </a>
                                <a class="text-decoration-none" href="/transaction-processing">
                                    <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                        <i class="mdi mdi-loading me-3 icon-lg text-warning"></i>
                                        <div class="d-flex flex-column justify-content-around me-5">
                                            <small class="mb-1 text-muted">Processing</small>
                                            <h5 class="me-2 mb-0"><span id="transaction_processing_status"></span></h5>
                                        </div>
                                    </div>
                                </a>
                                <a class="text-decoration-none" href="/transaction-failed">
                                    <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                        <i class="mdi mdi-alpha-x-circle me-3 icon-lg text-danger"></i>
                                        <div class="d-flex flex-column justify-content-around me-5">
                                            <small class="mb-1 text-muted">Failed</small>
                                            <h5 class="me-2 mb-0"><span id="transaction_failed_status"></span></h5>
                                        </div>
                                    </div>
                                </a>
                                <a class="text-decoration-none" href="/transaction-success">
                                    <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                        <i class="mdi mdi-check-circle me-3 icon-lg text-success"></i>
                                        <div class="d-flex flex-column justify-content-around me-5">
                                            <small class="mb-1 text-muted">Success</small>
                                            <h5 class="me-2 mb-0"><span id="transaction_success_status"></span></h5>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body dashboard-tabs p-0">
                    <ul class="nav nav-tabs px-4" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="comprehensive-report-tab" data-bs-toggle="tab" href="#comprehensive-report" role="tab" aria-controls="comprehensive-report" aria-selected="true">Comprehensive Report</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="transaction-report-tab" data-bs-toggle="tab" href="#transaction-report" role="tab" aria-controls="transaction-report" aria-selected="false">Transaction Report</a>
                        </li>
                    </ul>
                    <div class="tab-content py-0 px-0">
                        <div class="tab-pane fade show active" id="comprehensive-report" role="tabpanel" aria-labelledby="comprehensive-report-tab">
                            <div class="d-flex flex-wrap justify-content-xl-between">
                                <div class="col-sm-12 col-md-6 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <div id="daily-bookings-chart"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <div id="weekly-bookings-chart"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <div id="monthly-bookings-chart"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <div id="yearly-bookings-chart"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="transaction-report" role="tabpanel" aria-labelledby="transaction-report-tab">
                            <div class="d-flex flex-wrap justify-content-xl-between">
                                <div class="col-sm-12 col-md-6 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <div id="daily-payments-chart"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <div id="weekly-payments-chart"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <div id="monthly-payments-chart"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <div id="yearly-payments-chart"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body dashboard-tabs p-0">
                    <ul class="nav nav-tabs px-4" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="bookings-category-tab" data-bs-toggle="tab" href="#bookings-category" role="tab" aria-controls="bookings-category" aria-selected="true">Bookings by Category</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="other-report-tab" data-bs-toggle="tab" href="#other-report" role="tab" aria-controls="other-report" aria-selected="false">Other Report</a>
                        </li>
                    </ul>
                    <div class="tab-content py-0 px-0">
                        <div class="tab-pane fade show active" id="bookings-category" role="tabpanel" aria-labelledby="bookings-category-tab">
                            <div class="d-flex flex-wrap justify-content-xl-between">
                                <div class="col-sm-12 col-md-6 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <div id="bookings-service-type"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <div id="bookings-barangay"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="other-report" role="tabpanel" aria-labelledby="other-report-tab">
                            <div class="d-flex flex-wrap justify-content-xl-between">
                                <div class="col-sm-12 col-md-6 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <div id="inventory-report"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <div id="technician-services"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection