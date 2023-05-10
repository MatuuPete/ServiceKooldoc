@extends('layouts.admin')

@section('content')

<div class="modal fade" id="addFollowupStatusModal" tabindex="-1" aria-labelledby="addFollowupStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addFollowupStatusModalLabel">FOLLOW-UP STATUS</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="followup_status_form">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group">
                        <label for="followup_id">Follow-up ID:</label>
                        <input id="followup_id" name="followup_id" type="text" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label for="followup_status">Follow-up status:</label>
                        <input id="followup_status" name="followup_status" type="text" class="form-control text-capitalize" value="completed" disabled>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button id="add_followup_status" type="button" class="btn btn-primary">Check</button>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">All Finished Follow-up Service</h4>
                <div class="table-responsive">
                    <table id="all_finished_followup_service" class="table table-striped text-capitalize">
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
                                    FOLLOW-UP REPORT
                                </th>
                                <th>
                                    STATUS
                                </th>
                                <th>
                                    CHECK
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