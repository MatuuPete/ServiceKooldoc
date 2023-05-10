@extends('layouts.admin')

@section('content')

<div class="modal fade" id="addServiceStatusModal" tabindex="-1" aria-labelledby="addServiceStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addServiceStatusModalLabel">SERVICE STATUS</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="service_status_form">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group">
                        <label for="service_id">Service ID:</label>
                        <input id="service_id" name="service_id" type="text" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label for="service_status">Service status:</label>
                        <input id="service_status" name="service_status" type="text" class="form-control text-capitalize" value="completed" disabled>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button id="add_service_status" type="button" class="btn btn-primary">Check</button>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">All Finished Service</h4>
                <div class="table-responsive">
                    <table id="all_finished_service" class="table table-striped text-capitalize">
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
                                    SERVICE REPORT
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