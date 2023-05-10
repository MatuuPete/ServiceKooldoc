@extends('layouts.technician')

@section('content')

<div class="modal fade" id="editServiceReportModal" tabindex="-1" aria-labelledby="editServiceReportModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editServiceReportModalLabel">SERVICE REPORT</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="service_report_form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group">
                        <label for="service_id">Service ID:</label>
                        <input id="service_id" name="service_id" type="text" class="form-control" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="service_report" class="form-label">Service Report:</label>
                        <input type="file" class="form-control" id="service_report" name="service_report" accept=".jpeg,.jpg,.png" />
                    </div>
                    <div class="form-group">
                        <label for="service_status">Service status:</label>
                        <input id="service_status" name="service_status" type="text" class="form-control text-capitalize" value="finished" disabled>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button id="edit_service_report" type="button" class="btn btn-primary">Upload</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addFollowupServiceModal" tabindex="-1" aria-labelledby="addFollowupServiceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addFollowupServiceModalLabel">FOLLOW-UP SERVICE</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="followup_service_form">
                    @csrf

                    <div class="form-group">
                        <label for="service_id2">Service ID:</label>
                        <input id="service_id2" name="service_id2" type="text" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label for="reason">Reason:</label>
                        <textarea class="form-control" name="reason" id="reason" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button id="add_followup_service" type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Assigned Services</h4>
                <div class="table-responsive">
                    <table id="assigned_services" class="table table-striped text-capitalize">
                        <thead>
                            <tr>
                                <th>
                                    SERVICE ID
                                </th>
                                <th>
                                    CUSTOMER
                                </th>
                                <th>
                                    ADDRESS INFO
                                </th>
                                <th>
                                    CONTACT INFO
                                </th>
                                <th>
                                    TECHNICIANS
                                </th>
                                <th>
                                    SUPERVISOR
                                </th>
                                <th>
                                    BOOK TYPE
                                </th>
                                <th>
                                    SERVICE TYPE
                                </th>
                                <th>
                                    AC TYPE
                                </th>
                                <th>
                                    AC BRAND
                                </th>
                                <th>
                                    HORSEPOWER
                                </th>
                                <th>
                                    UNIT TYPE
                                </th>
                                <th>
                                    NO. OF UNIT
                                </th>
                                <th>
                                    DESCRIPTION
                                </th>
                                <th>
                                    IMAGE
                                </th>
                                <th>
                                    COOLING
                                </th>
                                <th>
                                    MECHANICAL NOISE
                                </th>
                                <th>
                                    ELECTRIC CONNECTIVITY
                                </th>
                                <th>
                                    DATE
                                </th>
                                <th>
                                    TIME
                                </th>
                                <th>
                                    PRICE
                                </th>
                                <th>
                                    STATUS
                                </th>
                                <th>
                                    REPORT
                                </th>
                                <th>
                                    FOLLOW-UP
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection