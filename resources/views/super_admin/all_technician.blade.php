@extends('layouts.super_admin')

@section('content')

<div class="modal fade" id="addTechnicianModal" tabindex="-1" aria-labelledby="addTechnicianModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addTechnicianModalLabel">ADD TECHNICIAN</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="add_technician_form">
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
                        <label for="age">Age:</label>
                        <input id="age" name="age" type="number" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="experience">Experience:</label>
                        <textarea class="form-control" name="experience" id="experience" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="specialties">Specialties:</label>
                        <textarea class="form-control" name="specialties" id="specialties" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button id="add_technician" type="button" class="btn btn-primary">Add</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editTechnicianModal" tabindex="-1" aria-labelledby="editTechnicianModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editTechnicianModalLabel">EDIT TECHNICIAN</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="edit_technician_form">
                    @csrf
                    <div class="form-group">
                        <label for="technician_id">Technician ID:</label>
                        <input id="technician_id" name="technician_id" type="text" class="form-control" disabled>
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
                        <label for="age2">Age:</label>
                        <input id="age2" name="age2" type="number" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="experience2">Experience:</label>
                        <textarea class="form-control" name="experience2" id="experience2" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="specialties2">Specialties:</label>
                        <textarea class="form-control" name="specialties2" id="specialties2" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button id="edit_technician" type="button" class="btn btn-primary">Update</button>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title">All Technician</h4>
                    <h4 class="card-title">Add
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addTechnicianModal"><i class="mdi mdi-plus"></i></button>
                    </h4>
                </div>
                <div class="table-responsive">
                    <table id="all_technician" class="table table-striped text-capitalize">
                        <thead>
                            <tr>
                                <th>
                                    TECHNICIAN ID
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
                                    AGE
                                </th>
                                <th>
                                    EXPERIENCE
                                </th>
                                <th>
                                    SPECIALTIES
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