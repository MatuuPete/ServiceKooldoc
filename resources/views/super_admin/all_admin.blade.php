@extends('layouts.super_admin')

@section('content')

<div class="modal fade" id="addAdminModal" tabindex="-1" aria-labelledby="addAdminModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addAdminModalLabel">ADD ADMIN</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="add_admin_form">
                    @csrf
                    <div class="form-group">
                        <label for="first_name">First Name:</label>
                        <input id="first_name" name="first_name" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name:</label>
                        <input id="last_name" name="last_name" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input id="email" name="email" type="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input id="password" name="password" type="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password:</label>
                        <input id="password-confirm" name="password_confirmation" type="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="phone_number">Phone Number:</label>
                        <input id="phone" name="phone" type="text" class="form-control" value="+63" disabled>
                        <input id="number" name="number" type="text" class="form-control" placeholder="Phone Number">
                    </div>
                    <div class="form-group">
                        <label for="team_position">Team Position:</label>
                        <input id="team_position" name="team_position" type="text" class="form-control">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button id="add_admin" type="button" class="btn btn-primary">Add</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editAdminModal" tabindex="-1" aria-labelledby="editAdminModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editAdminModalLabel">EDIT ADMIN</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="edit_admin_form">
                    @csrf
                    <div class="form-group">
                        <label for="admin_id">Admin ID:</label>
                        <input id="admin_id" name="admin_id" type="text" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label for="first_name2">First Name:</label>
                        <input id="first_name2" name="first_name2" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="last_name2">Last Name:</label>
                        <input id="last_name2" name="last_name2" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="team_position2">Team Position:</label>
                        <input id="team_position2" name="team_position2" type="text" class="form-control">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button id="edit_admin" type="button" class="btn btn-primary">Update</button>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title">All Admin</h4>
                    <h4 class="card-title">Add
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addAdminModal"><i class="mdi mdi-plus"></i></button>
                    </h4>
                </div>
                <div class="table-responsive">
                    <table id="all_admin" class="table table-striped text-capitalize">
                        <thead>
                            <tr>
                                <th>
                                    ADMIN ID
                                </th>
                                <th>
                                    USER ID
                                </th>
                                <th>
                                    FIRST NAME
                                </th>
                                <th>
                                    LAST NAME
                                </th>
                                <th>
                                    EMAIL
                                </th>
                                <th>
                                    PHONE NUMBER
                                </th>
                                <th>
                                    TEAM POSITION
                                </th>
                                <th>
                                    EDIT
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