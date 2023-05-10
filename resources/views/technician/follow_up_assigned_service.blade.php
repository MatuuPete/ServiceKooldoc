@extends('layouts.technician')

@section('content')

<div class="modal fade" id="editFollowupServiceReportModal" tabindex="-1" aria-labelledby="editFollowupServiceReportModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editFollowupServiceReportModalLabel">FOLLOW-UP SERVICE REPORT</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="followup_service_report_form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group">
                        <label for="followup_id">Follow-up service ID:</label>
                        <input id="followup_id" name="followup_id" type="text" class="form-control" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="followup_report" class="form-label">Follow-up service Report:</label>
                        <input type="file" class="form-control" id="followup_report" name="followup_report" accept=".jpeg,.jpg,.png" />
                    </div>
                    <div class="form-group">
                        <label for="followup_status">Follow-up service status:</label>
                        <input id="followup_status" name="followup_status" type="text" class="form-control text-capitalize" value="finished" disabled>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button id="edit_followup_service_report" type="button" class="btn btn-primary">Upload</button>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Follow-up Assigned Service</h4>
                <div class="table-responsive">
                    <table id="follow_up_assigned_service" class="table table-striped text-capitalize">
                        <thead>
                            <tr>
                                <th>
                                    SERVICE ID
                                </th>
                                <th>
                                    FOLLOW-UP ID
                                </th>
                                <th>
                                    TECHNICIANS
                                </th>
                                <th>
                                    SUPERVISOR
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
                                    REASON
                                </th>
                                <th>
                                    DATE
                                </th>
                                <th>
                                    TIME
                                </th>
                                <th>
                                    STATUS
                                </th>
                                <th>
                                    REPORT
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