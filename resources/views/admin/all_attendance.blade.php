@extends('layouts.admin')

@section('content')

<div class="modal fade" id="editAttendanceStatusModal" tabindex="-1" aria-labelledby="editAttendanceStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editAttendanceStatusModalLabel">EDIT ATTENDANCE STATUS</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="attendance_status_form">
                    @csrf
                    <div class="form-group">
                        <label for="attendance_id">Attendance ID:</label>
                        <input id="attendance_id" name="attendance_id" type="text" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label for="remarks">Remarks:</label>
                        <textarea class="form-control" name="remarks" id="remarks" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="attendance_status">Attendance status:</label>
                        <select id="attendance_status" name="attendance_status" class="form-control form-control-lg text-capitalize">
                            <option value="present">Present</option>
                            <option value="late">Late</option>
                            <option value="absent">Absent</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button id="edit_attendance_status" type="button" class="btn btn-primary">Update</button>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">All Attendance</h4>
                <div class="table-responsive">
                    <table id="all_attendance" class="table table-striped text-capitalize">
                        <thead>
                            <tr>
                                <th>
                                    ATTENDANCE ID
                                </th>
                                <th>
                                    TECHNICIAN ID
                                </th>
                                <th>
                                    FULL NAME
                                </th>
                                <th>
                                    DATE
                                </th>
                                <th>
                                    TIME IN 
                                </th>
                                <th>
                                    TIME OUT
                                </th>
                                <th>
                                    TOTAL TIME
                                </th>
                                <th>
                                    STATUS
                                </th>
                                <th>
                                    REMARKS
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