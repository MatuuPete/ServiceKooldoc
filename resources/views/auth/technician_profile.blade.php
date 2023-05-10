@extends('layouts.technician')

@section('content')

<div class="modal fade" id="editTechnicianProfileModal" tabindex="-1" aria-labelledby="editTechnicianProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editTechnicianProfileModalLabel">EDIT TECHNICIAN PROFILE</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="edit_technician_profile_form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group">
                        <label for="image">Profile:</label>
                        <input id="image" name="image" type="file" class="form-control" accept=".jpeg,.jpg,.png">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button id="edit_technician_profile" type="button" class="btn btn-primary">Update</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editPasswordModal" tabindex="-1" aria-labelledby="editPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editPasswordModalLabel">EDIT PASSWORD</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="edit_password_form">
                    @csrf
                    <div class="form-group">
                        <label for="current_password">Current password:</label>
                        <input id="current_password" name="current_password" type="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input id="password" name="password" type="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password:</label>
                        <input id="password-confirm" name="password_confirmation" type="password" class="form-control">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button id="edit_password" type="button" class="btn btn-primary">Update</button>
            </div>
        </div>
    </div>
</div>

<div class="loader">
    <div class="jimu-primary-loading"></div>
</div>
    <div class="row d-flex justify-content-center mt-2 text-capitalize">
        <div class="col-md-10 mt-5 pt-5">
            <div class="row shadow-lg">
                <div class="col-sm-4 bg-primary rounded-left d-flex align-items-center justify-content-center">
                    <div class="card-block text-center text-white mt-4 mb-3">
                        <img id="profile_image" class="img-fluid mb-3 rounded-circle" style="width: 150px; height: 150px;" alt="avatar">
                        <h3 class="font-weight-bold"><span id="profile_name"></span></h3>
                        <p><span id="profile_role"></p>
                        <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#editTechnicianProfileModal"><i class="mdi mdi-pencil"></i></button>
                    </div>
                </div>                  
                <div class="col-sm-8 bg-white rounded-right">
                    <h3 class="mt-3 text-center text-uppercase">Information</h3>   
                    <hr class="bg-primary mt-0 w-25 mx-auto">
                    <div class="row">
                        <div class="col-sm-6">
                            <p class="font-weight-bold"><strong>Email:</strong></p>
                            <h6 class="text-muted not-text-capitalize"><span id="profile_email"></span></h6>
                            <button id="verify_email" class="btn btn-primary text-white">Verify</button>
                        </div>
                        <div class="col-sm-6">
                            <p class="font-weight-bold"><strong>Phone:</strong></p>
                            <h6 class="text-muted"><span id="profile_phone"></span></h6>
                            <button class="btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#editPasswordModal">Change Password</button>
                        </div>
                    </div>
                    <hr class="bg-primary">
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <p class="font-weight-bold">Age</p>
                            <h6 class="text-muted"><span id="profile_age"></span></h6>
                        </div>
                        <div class="col-sm-6">
                            <p class="font-weight-bold">Experience</p>
                            <h6 class="text-muted"><span id="profile_experience"></span></h6>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <p class="font-weight-bold">Specialties</p>
                            <h6 class="text-muted"><span id="profile_specialties"></span></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
    window.addEventListener('load', function() {
        document.querySelector('.loader').remove();
    });
</script>
@endsection