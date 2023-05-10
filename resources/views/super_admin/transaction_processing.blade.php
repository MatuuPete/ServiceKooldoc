@extends('layouts.super_admin')

@section('content')

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title">All Processing Transaction</h4>
                    <h4 class="card-title">Back
                        <a href="{{ URL::previous() }}" class="btn btn-danger"><i class="mdi mdi-keyboard-return"></i></a>
                    </h4>
                </div>
                <div class="table-responsive">
                    <table id="all_processing_transaction" class="table table-striped text-capitalize">
                        <thead>
                            <tr>
                                <th>
                                    TRANSACTION ID
                                </th>
                                <th>
                                    SERVICE ID
                                </th>
                                <th>
                                    SERVICE PRICE
                                </th>
                                <th>
                                    VOUCHER ID
                                </th>
                                <th>
                                    DISCOUNT
                                </th>
                                <th>
                                    PAYMENT METHOD
                                </th>
                                <th>
                                    TOTAL AMOUNT
                                </th>
                                <th>
                                    PAYMENT PROOF
                                </th>
                                <th>
                                    NOTES
                                </th>
                                <th>
                                    DATE
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