@extends('layouts.customer')

@section('content')

<div class="modal fade" id="editTransactionHistoryModal" tabindex="-1" aria-labelledby="editTransactionHistoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editTransactionHistoryModalLabel">PAYMENT PROOF</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="transaction_history_form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group">
                        <label for="transaction_id">Transaction ID:</label>
                        <input id="transaction_id" name="transaction_id" type="text" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label for="transaction_history_payment_method">Payment Method:</label>
                        <select id="transaction_history_payment_method" name="transaction_history_payment_method" class="form-control form-control-lg text-capitalize">
                            <option value="cash on service">Cash On Service</option>
                            <option value="gcash">Gcash</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="payment_proof" class="form-label">Payment Proof:</label>
                        <input type="file" class="form-control" id="payment_proof" name="payment_proof" accept=".jpeg,.jpg,.png" />
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button id="edit_transaction_history" type="button" class="btn btn-primary">Upload</button>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Transaction History</h4>
                <div class="table-responsive">
                    <table id="transaction_histories" class="table table-striped text-capitalize">
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
                                <th>
                                    ADD/EDIT<br><span class="text-muted fst-italic">(Payment Proof)</span>
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