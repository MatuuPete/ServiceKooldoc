@extends('layouts.super_admin')

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">All Feedback</h4>
                <div class="table-responsive">
                    <table id="all_feedback" class="table table-striped text-capitalize">
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
                                    RATING 
                                </th>
                                <th>
                                    REVIEW
                                </th>
                                <th>
                                    DELETE
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