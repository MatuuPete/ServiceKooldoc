@extends('layouts.customer')

@section('content')

<div class="modal fade" id="addFeedbackModal" tabindex="-1" aria-labelledby="addFeedbackModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addFeedbackModalLabel">SERVICE FEEDBACK</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="feedback_form">
                    @csrf

                    <div class="form-group">
                        <label for="service_id">Service ID:</label>
                        <input id="service_id" name="service_id" type="text" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label for="rating">Rating:</label>
                        <label class="form-check-label ms-3">1</i></label>
                        <input class="form-check-input" type="radio" name="rating" value="1">
                        <label class="form-check-label ms-3">2</label>
                        <input class="form-check-input" type="radio" name="rating" value="2">
                        <label class="form-check-label ms-3">3</label>
                        <input class="form-check-input" type="radio" name="rating" value="3">
                        <label class="form-check-label ms-3">4</label>
                        <input class="form-check-input" type="radio" name="rating" value="4">
                        <label class="form-check-label ms-3">5</label>
                        <input class="form-check-input" type="radio" name="rating" value="5">
                    </div>
                    <div class="form-group">
                        <label for="review">Review:</label>
                        <textarea class="form-control" name="review" id="review" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button id="add_feedback" type="button" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addPostConsultationModal" tabindex="-1" aria-labelledby="addPostConsultationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addPostConsultationModalLabel">POST CONSULTATION</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="post_consultation_form">
                    @csrf

                    <div class="form-group">
                        <label for="service_id2">Service ID:</label>
                        <input id="service_id2" name="service_id2" type="text" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label for="message">Message:</label>
                        <textarea class="form-control" name="message" id="message" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button id="add_post_consultation" type="button" class="btn btn-primary">Send</button>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Completed Booked Service</h4>
                <div class="table-responsive">
                    <table id="completed_booked_service" class="table table-striped text-capitalize">
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
                                    SERVICE REPORT
                                </th>
                                <th>
                                    STATUS
                                </th>
                                <th>
                                    FEEDBACK
                                </th>
                                <th>
                                    POST CONSULT<br><span class="text-muted fst-italic">(After 7  Days)</span>
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