@extends('layouts.super_admin')

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Attendance Logs</h4>
                <div class="table-responsive">
                    <table id="attendance_logs" class="table table-striped text-capitalize">
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
                                    PHOTO IN
                                </th>
                                <th>
                                    TIME OUT
                                </th>
                                <th>
                                    PHOTO OUT
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