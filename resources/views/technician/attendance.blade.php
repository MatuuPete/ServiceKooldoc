@extends('layouts.technician')

@section('content')

<div class="modal fade" id="addTechnicianAttendanceModal" tabindex="-1" aria-labelledby="addTechnicianAttendanceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addTechnicianAttendanceModalLabel">TECHNICIAN ATTENDANCE</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="add_technician_attendance_form">
                    @csrf
                    <div class="form-group">
                        <label for="remarks">Remarks:</label>
                        <textarea class="form-control" name="remarks" id="remarks" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button id="add_technician_attendance" type="button" class="btn btn-primary">Login</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editTechnicianAttendanceModal" tabindex="-1" aria-labelledby="editTechnicianAttendanceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editTechnicianAttendanceModalLabel">TECHNICIAN ATTENDANCE</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="edit_technician_attendance_form">
                    @csrf
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button id="edit_technician_attendance" type="button" class="btn btn-primary">Logout</button>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title">Attendance</h4>
                    <h4 id="attendance_login" class="card-title">Login
                        <button id="login_button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addTechnicianAttendanceModal"><i class="mdi mdi-clock-in"></i></button>
                    </h4>
                </div>
                <div class="table-responsive">
                    <table id="technician_attendance" class="table table-striped text-capitalize">
                        <thead>
                            <tr>
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
                                    LOGOUT
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