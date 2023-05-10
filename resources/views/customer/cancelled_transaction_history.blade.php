@extends('layouts.customer')

@section('content')

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Cancelled Transaction History</h4>
                <div class="table-responsive">
                    <table id="cancelled_transaction_history" class="table table-striped text-capitalize">
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