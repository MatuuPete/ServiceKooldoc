@extends('layouts.super_admin')

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Inventory Logs</h4>
                <div class="table-responsive">
                    <table id="inventory_logs" class="table table-striped text-capitalize">
                        <thead>
                            <tr>
                                <th>
                                    LOG ID
                                </th>
                                <th>
                                    TECHNICIAN ID
                                </th>
                                <th>
                                    FULL NAME
                                </th>
                                <th>
                                    INVENTORY ID
                                </th>
                                <th>
                                    NAME
                                </th>
                                <th>
                                    QUANTITY
                                </th>
                                <th>
                                    BORROWED DATE
                                </th>
                                <th>
                                    RETURNED DATE
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