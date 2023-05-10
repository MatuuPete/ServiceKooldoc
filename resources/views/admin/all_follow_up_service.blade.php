@extends('layouts.admin')

@section('content')

<div class="modal fade" id="editFollowupScheduleModal" tabindex="-1" aria-labelledby="editFollowupScheduleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editFollowupScheduleModalLabel">SET SCHEDULE</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="followup_schedule_form">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group mt-3">
                        <label for="followup_date">Date</label>
                        <input type="text" class="form-control form-control-lg" id="followup_date" name="followup_date">
                    </div>
                    <div id="followup_time_options" class="form-group mt-3">
                        <label>Time Slot:</label>
                        <div class="form-check mt-2 ms-5">
                            <input class="form-check-input" type="radio" name="followup_time" id="slot1" value="6:00 A.M. - 9:00 A.M.">
                            <label id="followup_timeslot_1" class="form-check-label" for="slot1">6:00 A.M. - 9:00 A.M.</label>
                            <span id="followup_timeslot_status_1" class="form-check-label"></span>
                        </div>
                        <div class="form-check mt-2 ms-5">
                            <input class="form-check-input" type="radio" name="followup_time" id="slot2" value="9:00 A.M. - 12:00 P.M.">
                            <label id="followup_timeslot_2" class="form-check-label" for="slot2">9:00 A.M. - 12:00 P.M.</label>
                            <span id="followup_timeslot_status_2" class="form-check-label"></span>
                        </div>
                        <div class="form-check mt-2 ms-5">
                            <input class="form-check-input" type="radio" name="followup_time" id="slot3" value="12:00 P.M. - 3:00 P.M.">
                            <label id="followup_timeslot_3" class="form-check-label" for="slot3">12:00 P.M. - 3:00 P.M.</label>
                            <span id="followup_timeslot_status_3" class="form-check-label"></span>
                        </div>
                        <div class="form-check mt-2 ms-5">
                            <input class="form-check-input" type="radio" name="followup_time" id="slot4" value="3:00 P.M. - 6:00 P.M.">
                            <label id="followup_timeslot_4" class="form-check-label" for="slot4">3:00 P.M. - 6:00 P.M.</label>
                            <span id="followup_timeslot_status_4" class="form-check-label"></span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button id="edit_followup_schedule" type="button" class="btn btn-primary">Update</button>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">All Follow-up Service</h4>
                <div class="table-responsive">
                    <table id="all_follow_up_service" class="table table-striped text-capitalize">
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
                                    SET SCHEDULE
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