@extends('layouts.customer')

@section('content')

<div class="modal fade" id="editFeedbackModal" tabindex="-1" aria-labelledby="editFeedbackModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editFeedbackModalLabel">SERVICE FEEDBACK</h1>
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
                        <input class="form-check-input" type="radio" name="rating" id="star1" value="1">
                        <label class="form-check-label" for="star1"><i class="mdi mdi-star text-primary">1</i></label>
                        <input class="form-check-input" type="radio" name="rating" id="star2" value="2">
                        <label class="form-check-label" for="star2"><i class="mdi mdi-star text-primary">2</i></label>
                        <input class="form-check-input" type="radio" name="rating" id="star3" value="3">
                        <label class="form-check-label" for="star3"><i class="mdi mdi-star text-primary">3</i></label>
                        <input class="form-check-input" type="radio" name="rating" id="star4" value="4">
                        <label class="form-check-label" for="star4"><i class="mdi mdi-star text-primary">4</i></label>
                        <input class="form-check-input" type="radio" name="rating" id="star5" value="5">
                        <label class="form-check-label" for="star5"><i class="mdi mdi-star text-primary">5</i></label>
                    </div>
                    <div class="form-group">
                        <label for="review">Review:</label>
                        <textarea class="form-control" name="review" id="review" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button id="edit_feedback" type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Service Feedback</h4>
                <div class="table-responsive">
                    <table id="service_feedback" class="table table-striped text-capitalize">
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
                                    RATING 
                                </th>
                                <th>
                                    REVIEW
                                </th>
                                <th>
                                    EDIT<br><span class="text-muted fst-italic">(Every 30 days)</span>
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