@extends('layouts.super_admin')

@section('content')

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title">All Completed Service</h4>
                    <h4 class="card-title">Back
                        <a href="{{ URL::previous() }}" class="btn btn-danger"><i class="mdi mdi-keyboard-return"></i></a>
                    </h4>
                </div>
                <div class="table-responsive">
                    <table id="all_completed_service" class="table table-striped text-capitalize">
                        <thead>
                            <tr>
                                <th>
                                    SERVICE ID
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
                                    REPORT
                                </th>
                                <th>
                                    STATUS
                                </th>
                                <th>
                                    FOLLOW-UP ID
                                </th>
                                <th>
                                    REASON
                                </th>
                                <th>
                                    FOLLOW-UP DATE
                                </th>
                                <th>
                                    FOLLOW-UP TIME
                                </th>
                                <th>
                                    FOLLOW-UP REPORT
                                </th>
                                <th>
                                    FOLLOW-UP STATUS
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