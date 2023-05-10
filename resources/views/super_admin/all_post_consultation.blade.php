@extends('layouts.super_admin')

@section('content')

<div class="modal fade" id="addRecommendationModal" tabindex="-1" aria-labelledby="addRecommendationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addRecommendationModalLabel">RECOMMENDATION</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="recommendation_form">
                    @csrf
                    <input id="post_consultation_id" name="post_consultation_id" type="hiddenn" class="form-control" disabled>
                    <div class="form-group">
                        <label for="recommendation">Recommendation:</label>
                        <textarea class="form-control" name="recommendation" id="recommendation" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button id="add_recommendation" type="button" class="btn btn-primary">Reply</button>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">All Post Consultation</h4>
                <div class="table-responsive">
                    <table id="all_post_consultation" class="table table-striped text-capitalize">
                        <thead>
                            <tr>
                                <th>
                                    SERVICE ID
                                </th>
                                <th>
                                    CUSTOMER 
                                </th>
                                <th>
                                    TECHNICIANS 
                                </th>
                                <th>
                                    SUPERVISOR 
                                </th>
                                <th>
                                    MESSAGE 
                                </th>
                                <th>
                                    RECOMMENDATION
                                </th>
                                <th>
                                    DATE
                                </th>
                                <th>
                                    STATUS
                                </th>
                                <th>
                                    REPLY
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