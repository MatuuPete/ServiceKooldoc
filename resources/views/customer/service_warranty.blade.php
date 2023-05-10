@extends('layouts.customer')

@section('content')

<div class="modal fade" id="addWarrantyClaimModal" tabindex="-1" aria-labelledby="addWarrantyClaimModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addWarrantyClaimModalLabel">WARRANTY CLAIM</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="warranty_claim_form">
                    @csrf

                    <div class="form-group">
                        <label for="warranty_id">Warranty ID:</label>
                        <input id="warranty_id" name="warranty_id" type="text" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label for="statement">Statement:</label>
                        <textarea class="form-control" name="statement" id="statement" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button id="add_warranty_claim" type="button" class="btn btn-primary">Request</button>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Service Warranty</h4>
                <div class="table-responsive">
                    <table id="service_warranty" class="table table-striped text-capitalize">
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
                                    CLAIM
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