@extends('layouts.admin')

@section('content')

<div class="modal fade" id="editWarrantyClaimStatusModal" tabindex="-1" aria-labelledby="editWarrantyClaimStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editWarrantyClaimStatusModalLabel">EDIT WARRANTY CLAIM STATUS</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="warranty_claim_status_form">
                    @csrf
                    <div class="form-group">
                        <label for="warranty_id">Warranty ID:</label>
                        <input id="warranty_id" name="warranty_id" type="text" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label for="claim_status">Warranty claim status:</label>
                        <select id="claim_status" name="claim_status" class="form-control form-control-lg text-capitalize">
                            <option value="pending">Pending</option>
                            <option value="approved">Approved</option>
                            <option value="denied">Denied</option>
                            <option value="resolved">Resolved</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button id="edit_warranty_claim_status" type="button" class="btn btn-primary">Update</button>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">All Warranty Claim</h4>
                <div class="table-responsive">
                    <table id="all_warranty_claim" class="table table-striped text-capitalize">
                        <thead>
                            <tr>
                                <th>
                                    SERVICE ID
                                </th>
                                <th>
                                    CLAIM ID 
                                </th>
                                <th>
                                    WARRANTY ID 
                                </th>
                                <th>
                                    CLAIM DATE
                                </th>
                                <th>
                                    STATEMENT
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