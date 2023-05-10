@extends('layouts.technician')

@section('content')

<div class="modal fade" id="borrowInventoryModal" tabindex="-1" aria-labelledby="borrowInventoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="borrowInventoryModalLabel">BORROW INVENTORY</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="borrow_inventory_form">
                    @csrf
                    <div class="form-group">
                        <label for="inventory_id">Inventory ID:</label>
                        <input id="inventory_id" name="inventory_id" type="text" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity:</label>
                        <input id="quantity" name="quantity" type="number" min="1" class="form-control">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button id="add_borrow_inventory" type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Borrow Inventory</h4>
                <div class="table-responsive">
                    <table id="borrow_inventory" class="table table-striped text-capitalize">
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
                                    BORROW
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