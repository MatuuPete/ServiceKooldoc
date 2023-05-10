@extends('layouts.technician')

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Finished Follow-up Assigned Service</h4>
                <div class="table-responsive">
                    <table id="finished_followup_assigned_service" class="table table-striped text-capitalize">
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