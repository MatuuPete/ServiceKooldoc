@extends('layouts.technician')

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Return Inventory</h4>
                <div class="table-responsive">
                    <table id="return_inventory" class="table table-striped text-capitalize">
                        <thead>
                            <tr>
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
                                <th>
                                    RETURN
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