@extends('layouts.admin')

@section('content')

<div class="modal fade" id="editWarrantyStatusModal" tabindex="-1" aria-labelledby="editWarrantyStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editWarrantyStatusModalLabel">EDIT WARRANTY STATUS</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="warranty_status_form">
                    @csrf

                    <div class="form-group">
                        <label for="service_id">Service ID:</label>
                        <input id="service_id" name="service_id" type="text" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label for="warranty_status">Warranty status:</label>
                        <input id="warranty_status" name="warranty_status" type="text" class="form-control text-capitalize" value="voided" disabled>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button id="edit_warranty_status" type="button" class="btn btn-primary">Update</button>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">All Service Warranty</h4>
                <div class="table-responsive">
                    <table id="all_service_warranty" class="table table-striped text-capitalize">
                        <thead>
                            <tr>
                                <th>
                                    SERVICE ID
                                </th>
                                <th>
                                    WARRANTY ID 
                                </th>
                                <th>
                                    TYPE
                                </th>
                                <th>
                                    PERIOD
                                </th>
                                <th>
                                    START DATE  
                                </th>
                                <th>
                                    END DATE
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