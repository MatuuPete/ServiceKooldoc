@extends('layouts.master')

@section('body-class', 'sections-page sidebar-collapse')

@section('nav-class', 'navbar navbar-expand-lg bg-primary fixed-top')

@section('content')
<div class="wrapper">
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-8 ml-auto mr-auto text-center">
                    <h2 class="title">Book A Service</h2>
                </div>
            </div>
            <div class="row">
                <div class="card col-md-10 mx-auto shadow-lg">
                    <ul class="nav nav-tabs text-center" id="bookServiceTab" role="tablist">
                        <li class="nav-item col-md-3">
                            <a class="nav-link active p-3" id="step1-tab" data-toggle="tab" href="#step1" role="tab" aria-controls="step1" aria-selected="true">Step 1 of 5<br>AC Information</a>
                        </li>
                        <li class="nav-item col-md-2">
                            <a class="nav-link p-3" id="step2-tab" data-toggle="tab" href="#step2" role="tab" aria-controls="step2" aria-selected="false">Step 2 of 5<br>AC Initial Condition</a>
                        </li>
                        <li class="nav-item col-md-2">
                            <a class="nav-link p-3" id="step3-tab" data-toggle="tab" href="#step3" role="tab" aria-controls="step3" aria-selected="false">Step 3 of 5<br>Schedule</a>
                        </li>
                        <li class="nav-item col-md-3">
                            <a class="nav-link p-3" id="step4-tab" data-toggle="tab" href="#step4" role="tab" aria-controls="step4" aria-selected="false">Step 4 of 5<br>Customer Information</a>
                        </li>
                        <li class="nav-item col-md-2">
                            <a class="nav-link p-3" id="step5-tab" data-toggle="tab" href="#step5" role="tab" aria-controls="step5" aria-selected="false">Step 5 of 5<br>Payment Details</a>
                        </li>
                    </ul>
                    <form id="book_service_form" enctype="multipart/form-data">
                        <div class="tab-content" id="bookServiceTabContent">
                            <div class="tab-pane fade show active" id="step1" role="tabpanel" aria-labelledby="step1-tab">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                            <div class="form-group mt-3">
                                                <label for="service_type">Service Type</label>
                                                <select id="service_type" class="form-control form-control-lg" name="service_type">
                                                    <option value="">-- Select --</option>
                                                    <option value="cleaning">Cleaning</option>
                                                    <option value="installation">Installation</option>
                                                    <option value="repair">Repair</option>
                                                    <option value="maintenance">Maintenance</option>
                                                </select>
                                            </div>
                                            
                                            <div class="form-group mt-3">
                                                <label for="ac_type">Aircon Type</label>
                                                <select id="ac_type" class="form-control form-control-lg" name="ac_type">
                                                    <option value="">-- Select --</option>
                                                    <option value="window">Window</option>
                                                    <option value="split">Split</option>
                                                    <option value="tower">Tower</option>
                                                    <option value="cassette">Cassette</option>
                                                    <option value="suspended">Suspended</option>
                                                    <option value="concealed">Concealed</option>
                                                    <option value="u-shaped window">U-Shaped Window</option>
                                                </select>
                                            </div>
                                            
                                            <div class="form-group mt-3">
                                                <label for="ac_brand">Aircon Brand</label>
                                                    <select id="ac_brand" class="form-control form-control-lg text-capitalize" name="ac_brand">
                                                    <option value="">-- Select --</option>
                                                    <option value="daikin">Daikin</option>
                                                    <option value="mitsubishi electric">Mitsubishi Electric</option>
                                                    <option value="lg">LG</option>
                                                    <option value="carrier">Carrier</option>
                                                    <option value="panasonic">Panasonic</option>
                                                    <option value="samsung">Samsung</option>
                                                    <option value="fujitsu">Fujitsu</option>
                                                    <option value="toshiba">Toshiba</option>
                                                    <option value="hitachi">Hitachi</option>
                                                    <option value="other">Other</option>
                                                </select>
                                            </div>

                                            <div id="other_brand_option" class="form-group mt-3">
                                                <label for="other_brand">Other Brand</label>
                                                <input id="other_brand" type="text" class="form-control form-control-lg" name="other_brand">
                                            </div>
                                            
                                            <div class="form-group mt-3">
                                                <label for="ac_hp">Aircon Horsepower</label>
                                                <select id="ac_hp" class="form-control form-control-lg" name="ac_hp">
                                                    <option value="">-- Select --</option>
                                                    <option value="0.5">0.5</option>
                                                    <option value="0.75">0.75</option>
                                                    <option value="1.0">1.0</option>
                                                    <option value="1.5">1.5</option>
                                                    <option value="2.0">2.0</option>
                                                    <option value="2.5">2.5</option>
                                                    <option value="not known">Not Known</option>
                                                </select>
                                            </div>                                
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mt-3">
                                                <label for="unit_type">Unit Type</label>
                                                <select id="unit_type" class="form-control form-control-lg" name="unit_type">
                                                    <option value="">-- Select --</option>
                                                    <option value="inverter">Inverter</option>
                                                    <option value="non-inverter">Non-Inverter</option>
                                                    <option value="not known">Not Known</option>
                                                </select>
                                            </div>
                                            
                                            <div class="form-group mt-3">
                                                <label for="no_unit">Number of Units</label>
                                                <input id="no_unit" type="number" min="1" max="10" class="form-control form-control-lg" name="no_unit" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="2">
                                            </div>

                                            <div class="form-group mt-3">
                                                <label for="description">Description</label>
                                                <textarea id="description" class="form-control form-control-lg" name="description" placeholder="Room size (sq. m.), AC age, others..."></textarea>
                                            </div>

                                            <div class="form-group mt-3">
                                                <label for="image">Image <span class="text-muted fst-italic">(You can skip this)</span></label><br>
                                                <input type="text" id="file-name" class="form-control form-control-lg" readonly><br>
                                                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                                    <div>
                                                        <span class="btn btn-raised btn-round btn-primary btn-file">
                                                            <span class="fileinput-new">Add Photo</span>
                                                            <input type="file" id="image" name="image" accept=".jpeg,.jpg,.png" />
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-center mt-3 mb-3">
                                        <a href="#" data-toggle="modal" data-target="#pqModal">View Pricing</a>
                                    </div>
                                    
                                    <div class="d-flex justify-content-center mt-3 mb-3">
                                        <button id="nextBtn1" type="button" class="btn btn-primary btn-lg">Next</button>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="step2" role="tabpanel" aria-labelledby="step2-tab">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-4 d-flex justify-content-center">
                                            <div class="form-group mt-3">
                                                <label>Is it cooling in normal condition and the system functioning properly?</label>
                                                <div class="form-check form-check-radio">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="radio" name="cooling" value="yes">
                                                        <span class="form-check-sign">Yes</span>
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-radio">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="radio" name="cooling" value="no">
                                                        <span class="form-check-sign">No</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 d-flex justify-content-center">
                                            <div class="form-group mt-3">
                                                <label>Is there any mechanical noise during usage of aircon? 
                                                </label>
                                                <div class="form-check form-check-radio">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="radio" name="mechanical_noise" value="yes">
                                                        <span class="form-check-sign">Yes</span>
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-radio">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="radio" name="mechanical_noise" value="no">
                                                        <span class="form-check-sign">No</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 d-flex justify-content-center">
                                            <div class="form-group mt-3">
                                                <label>Is there a electric/power connectivity on your airconditioning unit?</label>
                                                <div class="form-check form-check-radio">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="radio" name="electric_connectivity" value="yes">
                                                        <span class="form-check-sign">Yes</span>
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-radio">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="radio" name="electric_connectivity" value="no">
                                                        <span class="form-check-sign">No</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="d-flex justify-content-center mt-3 mb-3">
                                        <button id="backBtn1" type="button" class="btn btn-primary btn-lg" style="margin-right: 10px">Back</button>
                                        <button id="nextBtn2" type="button" class="btn btn-primary btn-lg">Next</button>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="tab-pane fade" id="step3" role="tabpanel" aria-labelledby="step3-tab">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mt-3">
                                                <label for="service_date">Date</label>
                                                <input type="text" class="form-control form-control-lg" id="service_date" name="service_date">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div id="service_time_options" class="form-group mt-3">
                                                <label>Time Slot</label>
                                                <div class="form-check form-check-radio">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="radio" name="service_time" value="6:00 A.M. - 9:00 A.M.">
                                                        <span id="timeslot_1" class="form-check-sign">6:00 A.M. - 9:00 A.M.</span>
                                                        <span id="timeslot_status_1" class="form-check-label"></span>
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-radio">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="radio" name="service_time" value="9:00 A.M. - 12:00 P.M.">
                                                        <span id="timeslot_2" class="form-check-sign">9:00 A.M. - 12:00 P.M.</span>
                                                        <span id="timeslot_status_2" class="form-check-label"></span>
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-radio">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="radio" name="service_time" value="12:00 P.M. - 3:00 P.M.">
                                                        <span id="timeslot_3" class="form-check-sign">12:00 P.M. - 3:00 P.M.</span>
                                                        <span id="timeslot_status_3" class="form-check-label"></span>
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-radio">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="radio" name="service_time" value="3:00 P.M. - 6:00 P.M.">
                                                        <span id="timeslot_4" class="form-check-sign">3:00 P.M. - 6:00 P.M.</span>
                                                        <span id="timeslot_status_4" class="form-check-label"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="request_technicians_admin_options" class="row">
                                        <div class="col-12 text-center">
                                            <p><div class="col-12 text-center">
                                                <p class="text-muted"><em>You can skip this or select "No" if you don't prefer anyone, as the system will automatically assign a supervisor and technicians. Thank you for cooperation.</em></p>
                                            </div>
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mt-3">
                                                <label>Do you want to select/request technician/s?</label>
                                                <div class="form-check form-check-radio">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="radio" name="request_technicians" value="yes">
                                                        <span class="form-check-sign">Yes</span>
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-radio">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="radio" name="request_technicians" value="no">
                                                        <span class="form-check-sign">No</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mt-3">
                                                <label>Do you want to select/request supervisor?</label>
                                                <div class="form-check form-check-radio">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="radio" name="request_admin" value="yes">
                                                        <span class="form-check-sign">Yes</span>
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-radio">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="radio" name="request_admin" value="no">
                                                        <span class="form-check-sign">No</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div id="technician_list_options" class="col-md-6">
                                            <div class="form-group mt-3">
                                                <label for="technician_list">Technicians <span class="text-muted">(Max: 3)</span></label>
                                                <div id="technician-list">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div id="admin_list_options" class="col-md-6">
                                            <div class="form-group mt-3">
                                                <label for="admin_list">Supervisors</label>
                                                <div id="admin-list">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="d-flex justify-content-center mt-3 mb-3">
                                        <button id="backBtn2" type="button" class="btn btn-primary btn-lg" style="margin-right: 10px">Back</button>
                                        <button id="nextBtn3" type="button" class="btn btn-primary btn-lg">Next</button>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="tab-pane fade" id="step4" role="tabpanel" aria-labelledby="step4-tab">
                                <div class="container">
                                    <div id="user_customer_info" class="row">
                                        <div class="col-4">
                                            <div class="form-group mt-3">
                                                <label for="user_book_first_name">First Name</label>
                                                <input id="user_book_first_name" type="text" class="form-control form-control-lg form-control form-control-lg-lg text-capitalize" name="user_book_first_name" disabled>
                                            </div>
                                            <div class="form-group mt-3">
                                                <label for="user_book_phone_number">Phone Number</label>
                                                <input id="user_book_phone_number" type="text" class="form-control form-control-lg form-control form-control-lg-lg text-capitalize" name="user_book_phone_number" disabled>
                                            </div>
                                            <div class="form-group mt-3">
                                                <label for="user_book_city">City</label>
                                                <input id="user_book_city" type="text" class="form-control form-control-lg form-control form-control-lg-lg text-capitalize" name="user_book_city" disabled>
                                            </div>
                                            <div class="form-group mt-3">
                                                <label for="user_book_property_type">Property Type</label>
                                                <input id="user_book_property_type" type="text" class="form-control form-control-lg form-control form-control-lg-lg text-capitalize" name="user_book_property_type" disabled>
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="form-group mt-3">
                                                <label for="user_book_last_name">Last Name</label>
                                                <input id="user_book_last_name" type="text" class="form-control form-control-lg form-control form-control-lg-lg text-capitalize" name="user_book_last_name" disabled>
                                            </div>
                                            <div class="form-group mt-3">
                                                <label for="user_book_address">Address</label>
                                                <textarea id="user_book_address" type="text" class="form-control form-control-lg form-control form-control-lg-lg text-capitalize" name="user_book_address" placeholder="House No. & Block/Lot No. & Street No./Name" disabled></textarea>
                                            </div>
                                            <div class="form-group mt-3">
                                                <label for="user_book_province">Province</label>
                                                <input id="user_book_province" type="text" class="form-control form-control-lg form-control form-control-lg-lg text-capitalize" name="user_book_province" disabled>
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="form-group mt-3">
                                                <label for="user_book_email">Email</label>
                                                <input id="user_book_email" type="text" class="form-control form-control-lg form-control form-control-lg-lg" name="user_book_email" disabled>
                                            </div>
                                            <div class="form-group mt-3">
                                                <label for="user_book_barangay">Barangay</label>
                                                <input id="user_book_barangay" type="text" class="form-control form-control-lg form-control form-control-lg-lg text-capitalize" name="user_book_barangay" disabled>
                                            </div>
                                            <div class="form-group mt-3">
                                                <label for="user_book_zip_code">Zip Code</label>
                                                <input id="user_book_zip_code" type="text" class="form-control form-control-lg form-control form-control-lg-lg text-capitalize" name="user_book_zip_code" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="guest_customer_info" class="row">
                                        <div class="col-4">
                                            <div class="form-group mt-3">
                                                <label for="guest_book_first_name">First Name</label>
                                                <input id="guest_book_first_name" type="text" class="form-control form-control-lg form-control form-control-lg-lg text-capitalize" name="guest_book_first_name">
                                            </div>
                                            <div class="form-group mt-3">
                                                <label for="guest_book_email">Email</label>
                                                <input id="guest_book_email" type="email" class="form-control form-control-lg form-control form-control-lg-lg" name="guest_book_email">
                                            </div>
                                            <div class="form-group mt-3">
                                                <label for="guest_book_province">Province</label>
                                                <select id="guest_book_province" class="form-control form-control-lg" name="guest_book_province">
                                                    <option value="">-- Select --</option>
                                                    <option value="metro manila">Metro Manila</option>
                                                </select>
                                            </div>
                                            <div class="form-group mt-3">
                                                <label for="guest_book_zip_code">Zip Code</label>
                                                <input id="guest_book_zip_code" type="text" class="form-control form-control-lg form-control form-control-lg-lg text-capitalize" name="guest_book_zip_code" placeholder="Select Barangay" disabled>
                                            </div>
                                            <div class="form-group mt-3">
                                                <label for="guest_book_property_type">Property Type</label>
                                                <select id="guest_book_property_type" class="form-control form-control-lg" name="guest_book_property_type">
                                                    <option value="">-- Select --</option>
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
                                        </div>

                                        <div class="col-4">
                                            <div class="form-group mt-3">
                                                <label for="guest_book_last_name">Last Name</label>
                                                <input id="guest_book_last_name" type="text" class="form-control form-control-lg form-control form-control-lg-lg text-capitalize" name="guest_book_last_name">
                                            </div>
                                            <div class="form-group mt-3">
                                                <label for="guest_book_password">Password</label>
                                                <input id="guest_book_password" type="password" class="form-control form-control-lg form-control form-control-lg-lg" name="guest_book_password">
                                            </div>
                                            <div class="form-group mt-3">
                                                <label for="guest_book_city">City</label>
                                                <select id="guest_book_city" class="form-control form-control-lg" name="guest_book_city">
                                                    <option value="">-- Select --</option>
                                                    <option value="taguig">Taguig</option>
                                                </select>
                                            </div>
                                            <div class="form-group mt-3">
                                                <label for="guest_book_barangay">Barangay</label>
                                                <select id="guest_book_barangay" class="form-control form-control-lg" name="guest_book_barangay">
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
                                            
                                        </div>

                                        <div class="col-4">
                                            <div class="form-group mt-3">
                                                <label for="guest_book_phone_number">Phone Number</label>
                                                <input id="guest_book_phone_number" type="text" class="form-control form-control-lg form-control form-control-lg-lg text-capitalize" name="guest_book_phone_number">
                                            </div>
                                            <div class="form-group mt-3">
                                                <label for="guest_book_password_confirmation">Confirm Password</label>
                                                <input id="guest_book_password_confirmation" type="password" class="form-control form-control-lg form-control form-control-lg-lg" name="guest_book_password_confirmation">
                                            </div>
                                            <div class="form-group mt-3">
                                                <label for="guest_book_address">Address</label>
                                                <textarea id="guest_book_address" type="text" class="form-control form-control-lg form-control form-control-lg-lg text-capitalize" name="guest_book_address" placeholder="House No. & Block/Lot No. & Street No./Name"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-center mt-3 mb-3">
                                        <button id="backBtn3" type="button" class="btn btn-primary btn-lg" style="margin-right: 10px">Back</button>
                                        <button id="nextBtn4" type="button" class="btn btn-primary btn-lg">Next</button>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="step5" role="tabpanel" aria-labelledby="step5-tab">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mt-3">
                                                <label for="payment_method">Payment Method</label>
                                                <select id="payment_method" class="form-control form-control-lg form-control form-control-lg-lg" name="payment_method">
                                                    <option value="">-- Select --</option>
                                                    <option value="cash on service">Cash On Service</option>
                                                    <option value="gcash">Gcash</option>
                                                </select>
                                            </div>

                                            <div class="form-group mt-3">
                                                <label for="voucher_id">Voucher <span class="text-muted fst-italic">(You can skip this)</span></label>
                                                <input id="voucher_id" type="text" class="form-control form-control-lg form-control form-control-lg-lg" name="voucher_id">
                                            </div>

                                            <div class="form-group mt-3">
                                                <label for="notes">Notes <span class="text-muted fst-italic">(You can skip this)</span></label>
                                                <textarea id="notes" class="form-control form-control-lg text-capitalize" name="notes"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group mt-3">
                                                <label for="service_price">Service Price</label>
                                                <input id="service_price" type="text" class="form-control form-control-lg form-control form-control-lg-lg" name="service_price" disabled>
                                            </div>

                                            <div class="form-group mt-3">
                                                <label for="discount">Discount</label>
                                                <input id="discount" type="text" class="form-control form-control-lg form-control form-control-lg-lg" name="discount" disabled>
                                                <span id="voucher_status" class="form-check-label"></span>
                                            </div>

                                            <div class="form-group mt-3">
                                                <label for="amount">Total Amount</label>
                                                <input id="amount" type="text" class="form-control form-control-lg form-control form-control-lg-lg" name="amount" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="d-flex justify-content-center mt-3 mb-3">
                                        <button id="backBtn4" type="button" class="btn btn-primary btn-lg" style="margin-right: 10px">Back</button>
                                        <button id="book_btn" class="btn btn-primary btn-lg">Book Service</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="pqModal" tabindex="-1" role="dialog" aria-labelledby="tcppModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <i class="now-ui-icons ui-1_simple-remove"></i>
                </button>
                <h4 class="title title-up">Pricing Quotation</h4>
            </div>
            <div class="modal-body">
                <h5>Price starts at...</h5>
                <ol>
                    <li>
                        <strong>Clean</strong>
                        <br>
                        <ul>
                            <li>Window - ₱666.99</li>
                            <li>Split - ₱888.99</li>
                            <li>Tower - ₱999.99</li>
                            <li>Cassette - ₱1111.99</li>
                            <li>Suspended - ₱1299.99</li>
                            <li>Concealed - ₱1499.99</li>
                            <li>U-Shaped Window - ₱1699.99</li>
                        </ul>
                    </li>
                    <br>
                    <li>
                        <strong>Installation</strong>
                        <br>
                        <ul>
                            <li>Window - ₱999.99</li>
                            <li>Split - ₱1299.99</li>
                            <li>Tower - ₱1499.99</li>
                            <li>Cassette - ₱1699.99</li>
                            <li>Suspended - ₱1899.99</li>
                            <li>Concealed - ₱2099.99</li>
                            <li>U-Shaped Window - ₱2299.99</li>
                        </ul>
                    </li>
                    <br>
                    <li>
                        <strong>Repair</strong>
                        <br>
                        <ul>
                            <li>Window - ₱1499.99</li>
                            <li>Split - ₱1999.99</li>
                            <li>Tower - ₱2199.99</li>
                            <li>Cassette - ₱2499.99</li>
                            <li>Suspended - ₱2799.99</li>
                            <li>Concealed - ₱2999.99</li>
                            <li>U-Shaped Window - ₱3199.99</li>
                        </ul>
                    </li>
                    <br>
                    <li>
                        <strong>Maintenance</strong>
                        <br>
                        <ul>
                            <li>Window - ₱2499.99</li>
                            <li>Split - ₱2999.99</li>
                            <li>Tower - ₱3299.99</li>
                            <li>Cassette - ₱3499.99</li>
                            <li>Suspended - ₱3999.99</li>
                            <li>Concealed - ₱4499.99</li>
                            <li>U-Shaped Window - ₱4999.99</li>
                        </ul>
                    </li>
                </ol>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('nextBtn1').addEventListener('click', function() {
        document.getElementById('step2-tab').click();
    });
    document.getElementById('nextBtn2').addEventListener('click', function() {
        document.getElementById('step3-tab').click();
    });
    document.getElementById('nextBtn3').addEventListener('click', function() {
        document.getElementById('step4-tab').click();
    });
    document.getElementById('nextBtn4').addEventListener('click', function() {
        document.getElementById('step5-tab').click();
    });
    document.getElementById('backBtn1').addEventListener('click', function() {
        document.getElementById('step1-tab').click();
    });
    document.getElementById('backBtn2').addEventListener('click', function() {
        document.getElementById('step2-tab').click();
    });
    document.getElementById('backBtn3').addEventListener('click', function() {
        document.getElementById('step3-tab').click();
    });
    document.getElementById('backBtn4').addEventListener('click', function() {
        document.getElementById('step4-tab').click();
    });
    document.getElementById('image').onchange = function () {
        document.getElementById('file-name').value = this.value.split("\\").pop();
    }
</script>

@endsection
