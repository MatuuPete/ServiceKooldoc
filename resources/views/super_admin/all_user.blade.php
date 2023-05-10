@extends('layouts.super_admin')

@section('content')

<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editUserModalLabel">EDIT USER</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="edit_user_form">
                    @csrf
                    <div class="form-group">
                        <label for="user_id">User ID:</label>
                        <input id="user_id" name="user_id" type="text" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input id="email" name="email" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="phone_number">Phone Number:</label>
                        <input id="phone" name="phone" type="text" class="form-control" value="+63" disabled>
                        <input id="number" name="number" type="text" class="form-control" placeholder="Phone Number">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button id="edit_user" type="button" class="btn btn-primary">Update</button>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">All User</h4>
                <div class="table-responsive">
                    <table id="all_user" class="table table-striped text-capitalize">
                        <thead>
                            <tr>
                                <th>
                                    USER ID
                                </th>
                                <th>
                                    ROLE 
                                </th>
                                <th>
                                    ROLE ID 
                                </th>
                                <th>
                                    FULL NAME
                                </th>
                                <th>
                                    EMAIL
                                </th>
                                <th>
                                    PHONE NUMBER
                                </th>
                                <th>
                                    EDIT
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