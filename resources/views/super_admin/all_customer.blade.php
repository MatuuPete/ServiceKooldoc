@extends('layouts.super_admin')

@section('content')

<div class="modal fade" id="addCustomerModal" tabindex="-1" aria-labelledby="addCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addCustomerModalLabel">ADD CUSTOMER</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="add_customer_form">
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
                <button id="add_customer" type="button" class="btn btn-primary">Add</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editCustomerModal" tabindex="-1" aria-labelledby="editCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editCustomerModalLabel">EDIT CUSTOMER</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="edit_customer_form">
                    @csrf
                    <div class="form-group">
                        <label for="customer_id">Customer ID:</label>
                        <input id="customer_id" name="customer_id" type="text" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label for="edit_first_name">First Name:</label>
                        <input id="edit_first_name" name="edit_first_name" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="edit_last_name">Last Name:</label>
                        <input id="edit_last_name" name="edit_last_name" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="edit_address">Address:</label>
                        <textarea class="form-control" name="edit_address" id="edit_address" rows="3" placeholder="House No. & Block/Lot No. & Street No./Name"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="edit_barangay">Barangay:</label>
                        <select id="edit_barangay" class="form-control form-control-lg" name="edit_barangay">
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
                        <label for="edit_city">City:</label>
                        <select id="edit_city" class="form-control form-control-lg" name="edit_city">
                            <option value="">-- Select --</option>
                            <option value="taguig">Taguig</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_province">Province:</label>
                        <select id="edit_province" class="form-control form-control-lg" name="edit_province">
                            <option value="">-- Select --</option>
                            <option value="metro manila">Metro Manila</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_zip_code">Zip Code:</label>
                        <input id="edit_zip_code" name="edit_zip_code" type="text" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label for="edit_property_type">Property Type:</label>
                        <select id="edit_property_type" name="edit_property_type" class="form-control form-control-lg">
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
                <button id="edit_customer" type="button" class="btn btn-primary">Edit</button>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title">All Customer</h4>
                    <h4 class="card-title">Add
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addCustomerModal"><i class="mdi mdi-plus"></i></button>
                    </h4>
                </div>
                <div class="table-responsive">
                    <table id="all_customer" class="table table-striped text-capitalize">
                        <thead>
                            <tr>
                                <th>
                                    CUSTOMER ID
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
                                    PROPERTY TYPE
                                </th>
                                <th>
                                    ADDRESS
                                </th>
                                <th>
                                    BARANGAY
                                </th>
                                <th>
                                    CITY
                                </th>
                                <th>
                                    PROVINCE
                                </th>
                                <th>
                                    ZIP CODE
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