@extends('layouts.customer')

@section('content')

<div class="modal fade" id="editCustomerProfileModal" tabindex="-1" aria-labelledby="editCustomerProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editCustomerProfileModalLabel">EDIT CUSTOMER PROFILE</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="edit_customer_profile_form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group">
                        <label for="image">Profile:</label>
                        <input id="image" name="image" type="file" class="form-control" accept=".jpeg,.jpg,.png">
                    </div>
                    <div class="form-group">
                        <label for="first_name">First Name:</label>
                        <input id="first_name" name="first_name" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name:</label>
                        <input id="last_name" name="last_name" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="phone_number">Phone Number:</label>
                        <input id="phone" name="phone" type="text" class="form-control" value="+63" disabled>
                        <input id="number" name="number" type="text" class="form-control" placeholder="Phone Number">   
                    </div>
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <textarea class="form-control" name="address" id="address" rows="3" placeholder="House No. & Block/Lot No. & Street No./Name"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="barangay">Barangay:</label>
                        <select id="barangay" class="form-control form-control-lg" name="barangay">
                            <option value="">-- Select --</option>
                            <option value="bagong tanyag">Bagong Tanyag</option>
                            <option value="bagumbayan">Bagumbayan</option>
                            <option value="bambang">Bambang</option>
                            <option value="calzada">Calzada</option>
                            <option value="central bicutan">Central Bicutan</option>
                            <option value="central signal village">Central Signal Village</option>
                            <option value="fort bonifacio">Fort Bonifacio</option>
                            <option value="hagonoy">Hagonoy</option>
                            <option value="ibayo tipas">Ibayo Tipas</option>
                            <option value="ligid tipas">Ligid Tipas</option>
                            <option value="lower bicutan">Lower Bicutan</option>
                            <option value="maharlika village">Maharlika Village</option>
                            <option value="napindan">Napindan</option>
                            <option value="new lower bicutan">New Lower Bicutan</option>
                            <option value="north daang hari">North Daang Hari</option>
                            <option value="north signal village">North Signal Village</option>
                            <option value="palingon">Palingon</option>
                            <option value="pinagsama">Pinagsama</option>
                            <option value="san miguel">San Miguel</option>
                            <option value="santa ana">Santa Ana</option>
                            <option value="south daang hari">South Daang Hari</option>
                            <option value="south signal village">South Signal Village</option>
                            <option value="tuktukan">Tuktukan</option>
                            <option value="upper bicutan">Upper Bicutan</option>
                            <option value="ususan">Ususan</option>
                            <option value="wawa">Wawa</option>
                            <option value="western bicutan">Western Bicutan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="city">City:</label>
                        <select id="city" class="form-control form-control-lg" name="city">
                            <option value="">-- Select --</option>
                            <option value="taguig">Taguig</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="province">Province:</label>
                        <select id="province" class="form-control form-control-lg" name="province">
                            <option value="">-- Select --</option>
                            <option value="metro manila">Metro Manila</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="zip_code">Zip Code:</label>
                        <input id="zip_code" name="zip_code" type="text" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label for="property_type">Property Type:</label>
                        <select id="property_type" name="property_type" class="form-control form-control-lg">
                            <option value="house">House</option>
                            <option value="duplexes">Duplexes</option>
                            <option value="apartment">Apartment</option>
                            <option value="condominium">Condominium</option>
                            <option value="town house">Town House</option>
                            <option value="club house">Club House</option>
                            <option value="studio">Studio</option>
                            <option value="warehouse">Warehouse</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button id="edit_customer_profile" type="button" class="btn btn-primary">Update</button>
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

<div class="row d-flex justify-content-center mt-2 text-capitalize">
    <div class="col-md-10 mt-5 pt-5">
        <div class="row shadow-lg">
            <div class="col-sm-4 bg-primary rounded-left d-flex align-items-center justify-content-center">
                <div class="card-block text-center text-white mt-4 mb-3">
                    <img id="profile_image" class="img-fluid mb-3 rounded-circle" style="width: 150px; height: 150px;" alt="avatar">
                    <h3 class="font-weight-bold"><span id="profile_name"></span></h3>
                    <p><span id="profile_role"></p>      
                    <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#editCustomerProfileModal"><i class="mdi mdi-pencil"></i></button>                     
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
                        <p class="font-weight-bold">Address</p>
                        <h6 class="text-muted"><span id="profile_address"></span></h6>
                    </div>
                    <div class="col-sm-6">
                        <p class="font-weight-bold">Barangay</p>
                        <h6 class="text-muted"><span id="profile_barangay"></span></h6>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-6">
                        <p class="font-weight-bold">City</p>
                        <h6 class="text-muted"><span id="profile_city"></span></h6>
                    </div>
                    <div class="col-sm-6">
                        <p class="font-weight-bold">Province</p>
                        <h6 class="text-muted"><span id="profile_province"></span></h6>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-6">
                        <p class="font-weight-bold">Zip Code</p>
                        <h6 class="text-muted"><span id="profile_zip"></span></h6>
                    </div>
                    <div class="col-sm-6">
                        <p class="font-weight-bold">Property Type</p>
                        <h6 class="text-muted"><span id="profile_property"></span></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection