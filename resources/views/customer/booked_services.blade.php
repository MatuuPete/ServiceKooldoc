@extends('layouts.customer')

@section('content')

<div class="modal fade" id="addCancelModal" tabindex="-1" aria-labelledby="addCancelModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addCancelModalLabel">CANCEL SERVICE</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="cancel_form">
                    @csrf

                    <div class="form-group">
                        <label for="service_id">Service ID:</label>
                        <input id="service_id" name="service_id" type="text" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label for="why">Why:</label>
                        <div class="form-check mt-2 ms-5">
                            <input class="form-check-input" type="radio" name="why" value="change in plans">
                            <label class="form-check-label">Change in Plans</i></label>
                        </div>
                        <div class="form-check mt-2 ms-5">
                            <input class="form-check-input" type="radio" name="why" value="schedule conflict">
                            <label class="form-check-label">Schedule Conflict</label>
                        </div>
                        <div class="form-check mt-2 ms-5">
                            <input class="form-check-input" type="radio" name="why" value="unforeseen circumstances">
                            <label class="form-check-label">Unforeseen Circumstances</label>
                        </div>
                        <div class="form-check mt-2 ms-5">
                            <input class="form-check-input" type="radio" name="why" value="dissatisfied with service">
                            <label class="form-check-label">Dissatisfied with Service</label>
                        </div>
                        <div class="form-check mt-2 ms-5">
                            <input class="form-check-input" type="radio" name="why" value="cost concerns">
                            <label class="form-check-label">Cost Concerns</label>
                        </div>
                        <div class="form-check mt-2 ms-5">
                            <input class="form-check-input" type="radio" name="why" value="found a better deal">
                            <label class="form-check-label">Found a Better Deal</label>
                        </div>
                        <div class="form-check mt-2 ms-5">
                            <input class="form-check-input" type="radio" name="why" value="poor communication">
                            <label class="form-check-label">Poor Communication</label>
                        </div>
                        <div class="form-check mt-2 ms-5">
                            <input class="form-check-input" type="radio" name="why" value="bad reputation">
                            <label class="form-check-label">Bad Reputation</label>
                        </div>
                        <div class="form-check mt-2 ms-5">
                            <input class="form-check-input" type="radio" name="why" value="other">
                            <label class="form-check-label">Other</label>
                        </div>
                    </div>
                    <div id="other_why_option" class="form-group">
                        <label>Other Reason:</label>
                        <textarea class="form-control" name="other_why" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button id="add_cancel" type="button" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title">Booked Services</h4>
                    <h4 class="card-title">Book
                        <a href="/book-service" class="btn btn-success"><i class="mdi mdi-book"></i></a>
                    </h4>
                </div>
                <div class="table-responsive">
                    <table id="booked_services" class="table table-striped text-capitalize">
                        <thead>
                            <tr>
                                <th>
                                    SERVICE ID
                                </th>
                                <th>
                                    TECHNICIANS
                                </th>
                                <th>
                                    SUPERVISOR
                                </th>
                                <th>
                                    CONTACT
                                </th>
                                <th>
                                    BOOK TYPE
                                </th>
                                <th>
                                    SERVICE TYPE
                                </th>
                                <th>
                                    AC TYPE
                                </th>
                                <th>
                                    AC BRAND
                                </th>
                                <th>
                                    HORSEPOWER
                                </th>
                                <th>
                                    UNIT TYPE
                                </th>
                                <th>
                                    NO. OF UNIT
                                </th>
                                <th>
                                    DESCRIPTION
                                </th>
                                <th>
                                    IMAGE
                                </th>
                                <th>
                                    COOLING
                                </th>
                                <th>
                                    MECHANICAL NOISE
                                </th>
                                <th>
                                    ELECTRIC CONNECTIVITY
                                </th>
                                <th>
                                    DATE
                                </th>
                                <th>
                                    TIME
                                </th>
                                <th>
                                    PRICE
                                </th>
                                <th>
                                    STATUS
                                </th>
                                <th>
                                    CANCEL
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