@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">All Cancelled Transaction</h4>
                <div class="table-responsive">
                    <table id="all_cancelled_transaction" class="table table-striped text-capitalize">
                        <thead>
                            <tr>
                                <th>
                                    TRANSACTION ID
                                </th>
                                <th>
                                    SERVICE ID
                                </th>
                                <th>
                                    CUSTOMER
                                </th>
                                <th>
                                    ADDRESS INFO
                                </th>
                                <th>
                                    CONTACT INFO
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