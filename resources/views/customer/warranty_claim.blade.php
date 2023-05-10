@extends('layouts.customer')

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Warranty Claim</h4>
                <div class="table-responsive">
                    <table id="warranty_claim" class="table table-striped text-capitalize">
                        <thead>
                            <tr>
                                <th>
                                    SERVICE ID
                                </th>
                                <th>
                                    CLAIM ID 
                                </th>
                                <th>
                                    WARRANTY ID 
                                </th>
                                <th>
                                    CLAIM DATE
                                </th>
                                <th>
                                    STATEMENT
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