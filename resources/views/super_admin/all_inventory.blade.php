@extends('layouts.super_admin')

@section('content')

<div class="modal fade" id="addInventoryModal" tabindex="-1" aria-labelledby="addInventoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addInventoryModalLabel">ADD INVENTORY</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="add_inventory_form">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input id="name" name="name" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="stock">Stock:</label>
                        <input class="form-control" name="stock" id="stock" type="number" min="1">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button id="add_inventory" type="button" class="btn btn-primary">Add</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editInventoryModal" tabindex="-1" aria-labelledby="editInventoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editInventoryModalLabel">EDIT INVENTORY</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="add_inventory_form">
                    @csrf
                    <div class="form-group">
                        <label for="inventory_id">Inventory ID:</label>
                        <input id="inventory_id" name="inventory_id" type="text" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label for="name2">Name:</label>
                        <input id="name2" name="name2" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="description2">Description:</label>
                        <textarea class="form-control" name="description2" id="description2" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="stock2">Stock:</label>
                        <input class="form-control" name="stock2" id="stock2" type="number" min="1">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button id="edit_inventory" type="button" class="btn btn-primary">Update</button>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title">All Inventory</h4>
                    <h4 class="card-title">Add
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addInventoryModal"><i class="mdi mdi-plus"></i></button>
                    </h4>
                </div>
                <div class="table-responsive">
                    <table id="all_inventory" class="table table-striped text-capitalize">
                        <thead>
                            <tr>
                                <th>
                                    INVENTORY ID
                                </th>
                                <th>
                                    NAME
                                </th>
                                <th>
                                    STOCK
                                </th>
                                <th>
                                    DESCRIPTION
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