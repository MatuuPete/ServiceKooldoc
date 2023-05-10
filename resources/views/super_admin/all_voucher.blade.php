@extends('layouts.super_admin')

@section('content')

<div class="modal fade" id="addVoucherModal" tabindex="-1" aria-labelledby="addVoucherModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addVoucherModalLabel">ADD VOUCHER</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="add_voucher_form">
                    @csrf
                    <div class="form-group">
                        <label for="discount">Discount:</label>
                        <input id="discount" name="discount" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="start_date">Start Date:</label>
                        <input id="start_date" type="date" class="form-control" name="start_date" pattern="\d{4}-\d{2}-\d{2}">
                    </div>
                    <div class="form-group">
                        <label for="end_date">End Date:</label>
                        <input id="end_date" type="date" class="form-control" name="end_date" pattern="\d{4}-\d{2}-\d{2}">
                    </div>
                    <div class="form-group">
                        <label for="usage_count">Usage Count:</label>
                        <input class="form-control" name="usage_count" id="usage_count" type="number" min="1">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button id="add_voucher" type="button" class="btn btn-primary">Add</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editVoucherModal" tabindex="-1" aria-labelledby="editVoucherModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editVoucherModalLabel">EDIT VOUCHER</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="edit_voucher_form">
                    @csrf
                    <div class="form-group">
                        <label for="voucher_id">Voucher ID:</label>
                        <input id="voucher_id" name="voucher_id" type="text" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label for="discount2">Discount:</label>
                        <input id="discount2" name="discount2" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="description2">Description:</label>
                        <textarea class="form-control" name="description2" id="description2" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="start_date2">Start Date:</label>
                        <input id="start_date2" type="date" class="form-control" name="start_date2" pattern="\d{4}-\d{2}-\d{2}">
                    </div>
                    <div class="form-group">
                        <label for="end_date2">End Date:</label>
                        <input id="end_date2" type="date" class="form-control" name="end_date2" pattern="\d{4}-\d{2}-\d{2}">
                    </div>
                    <div class="form-group">
                        <label for="usage_count2">Usage Count:</label>
                        <input class="form-control" name="usage_count2" id="usage_count2" type="number" min="1">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button id="edit_voucher" type="button" class="btn btn-primary">Update</button>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title">All Voucher</h4>
                    <h4 class="card-title">Add
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addVoucherModal"><i class="mdi mdi-plus"></i></button>
                    </h4>
                </div>
                <div class="table-responsive">
                    <table id="all_voucher" class="table table-striped text-capitalize">
                        <thead>
                            <tr>
                                <th>
                                    VOUCHER ID
                                </th>
                                <th>
                                    DISCOUNT
                                </th>
                                <th>
                                    DESCRIPTION
                                </th>
                                <th>
                                    START DATE
                                </th>
                                <th>
                                    END DATE
                                </th>
                                <th>
                                    USAGE COUNT
                                </th>
                                <th>
                                    STATUS
                                </th>
                                <th>
                                    EDIT
                                </th>
                                <th>
                                    DELETE
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