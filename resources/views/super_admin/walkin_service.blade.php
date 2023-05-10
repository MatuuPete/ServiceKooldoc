@extends('layouts.super_admin')

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title">Walk-in Service</h4>
                    <h4 class="card-title">Book
                        <a href="/walkin-book" class="btn btn-success"><i class="mdi mdi-book"></i></a>
                    </h4>
                </div>
                <div class="table-responsive">
                    <table id="walkin_service" class="table table-striped text-capitalize">
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
                                    REPORT
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