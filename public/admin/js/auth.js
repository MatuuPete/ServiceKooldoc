$(document).ready(function (){
    const token = localStorage.getItem('access_token');
    const expiresAt = localStorage.getItem("access_token_expires_at");
    
    $('#service_type, #ac_type, #no_unit, #voucher_id').on('change input', function() {
        var selected_option = $('#service_type').val();
        var ac_type = $('#ac_type').val();
        var amount;

        if (selected_option === 'cleaning') 
        {
            if (ac_type === 'window') 
            {
                amount = 666.99;
            } 
            else if (ac_type === 'split') 
            {
                amount = 888.99;
            }
            else if (ac_type === 'tower') 
            {
                amount = 999.99;
            } 
            else if (ac_type === 'cassette') 
            {
                amount = 1111.99;
            }
            else if (ac_type === 'suspended') 
            {
                amount = 1299.99;
            }
            else if (ac_type === 'concealed') 
            {
                amount = 1499.99;
            }
            else if (ac_type === 'u-shaped window') 
            {
                amount = 1699.99;
            }
            else 
            {
                amount = 0;
            }
        } 
        else if (selected_option === 'installation') 
        {
            if (ac_type === 'window') {
                amount = 999.99;
            } 
            else if (ac_type === 'split') 
            {
                amount = 1299.99;
            }
            else if (ac_type === 'tower') 
            {
                amount = 1499.99;
            } 
            else if (ac_type === 'cassette') 
            {
                amount = 1699.99;
            }
            else if (ac_type === 'suspended') 
            {
                amount = 1899.99;
            }
            else if (ac_type === 'concealed') 
            {
                amount = 2099.99;
            }
            else if (ac_type === 'u-shaped window') 
            {
                amount = 2299.99;
            }
            else 
            {
                amount = 0;
            }
        } 
        else if (selected_option === 'repair') 
        {
            if (ac_type === 'window') 
            {
                amount = 1499.99;
            } 
            else if (ac_type === 'split') 
            {
                amount = 1999.99;
            }
            else if (ac_type === 'tower') 
            {
                amount = 2199.99;
            } 
            else if (ac_type === 'cassette') 
            {
                amount = 2499.99;
            }
            else if (ac_type === 'suspended') 
            {
                amount = 2799.99;
            }
            else if (ac_type === 'concealed') 
            {
                amount = 2999.99;
            }
            else if (ac_type === 'u-shaped window') 
            {
                amount = 3199.99;
            }
            else 
            {
                amount = 0;
            }
        } 
        else if (selected_option === 'maintenance') 
        {
            if (ac_type === 'window') 
            {
                amount = 2499.99;
            } 
            else if (ac_type === 'split') 
            {
                amount = 2999.99;
            }
            else if (ac_type === 'tower') 
            {
                amount = 3299.99;
            } 
            else if (ac_type === 'cassette') 
            {
                amount = 3699.99;
            }
            else if (ac_type === 'suspended')
            {
                amount = 4099.99;
            }
            else if (ac_type === 'concealed')
            {
                amount = 4499.99;
            }
            else if (ac_type === 'u-shaped window')
            {
                amount = 4899.99;
            }
            else
            {
                amount = 0;
            }
        }

        var no_unit = $('#no_unit').val();

        var service_price = no_unit * amount;
        $('#service_price').val(service_price.toFixed(2));

        var discount = 0;
        var voucher_id = $('#voucher_id').val();
        if (voucher_id !== '') 
        {
            $.ajax({
                url: '/api/vouchers/all',
                type: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Authorization': 'Bearer ' + token,
                },
                async: false,
                success: function(response) {
                    var vouchers = response.vouchers;
                    var found = false;
                    for (var i = 0; i < vouchers.length; i++) {
                        if (voucher_id == vouchers[i].id) {
                            discount = vouchers[i].discount;
                            found = true;
                            break;
                        }
                    }
                    if (found) 
                    {
                        $('#discount').val(discount);
                        $('#voucher_status').text('Discount applied!');
                    } 
                    else 
                    {
                        $('#discount').val(0);
                        $('#voucher_status').text('Invalid voucher code!');
                    }
                },
                error: function(xhr, status, error) {
                    alert(xhr.responseText);
                }
            });
        }
        else
        {
            $('#voucher_status').text('');
        }

        var amount = service_price - discount;
        $('#discount').val(discount);
        $('#amount').val(amount.toFixed(2));
    });

    $('#other_brand_option').hide();

    $('#ac_brand').on('change', function() {
        if ($(this).val() === "other") {
            $('#other_brand_option').show();
        } else {
            $('#other_brand_option').hide();
        }
    });    

    $("#service_date").datepicker({
        minDate: 1,
        dateFormat: 'yy-mm-dd',
        beforeShowDay: function(date) {
            var day = date.getDay();
            return [!(day === 6 || day === 0) && date.getTime() >= new Date().getTime()];
        }
    });

    $('#service_time_options').hide();

    $('#service_date').on('change', function() {
        var selectedDate = $(this).val();
        if (selectedDate) 
        {
            $('#service_time_options').show();
        } 
    });
    
    $('#request_technicians_admin_options').hide();

    $('input[name="service_time"]').on('change', function() {
        if ($(this).is(":checked")) {
            $('#request_technicians_admin_options').show();
        }
    });
    
    $('#technician_list_options').hide();

    $('input[name="request_technicians"]').on('change', function() {
        if ($(this).val() === 'yes') {
            $('#technician_list_options').show();
        } else {
            $('#technician_list_options').hide();
        }
    });
    
    $('#admin_list_options').hide();

    $('input[name="request_admin').on('change', function() {
        if ($(this).val() === 'yes') {
            $('#admin_list_options').show();
        } else {
            $('#admin_list_options').hide();
        }
    });

    $("#barangay").change(function() {
        var barangay = $(this).val();
        
        switch (barangay) {
            case "bagumbayan":
            $("#zip_code").val("1630");
            break;
            case "bambang":
            $("#zip_code").val("1637");
            break;
            case "calzada":
            $("#zip_code").val("1630");
            break;
            case "hagonoy":
            $("#zip_code").val("1630");
            break;
            case "ibayo tipas":
            $("#zip_code").val("1630");
            break;
            case "ligid tipas":
            $("#zip_code").val("1638");
            break;
            case "lower bicutan":
            $("#zip_code").val("1632");
            break;
            case "new lower bicutan":
            $("#zip_code").val("1632");
            break;
            case "napindan":
            $("#zip_code").val("1630");
            break;
            case "palingon":
            $("#zip_code").val("1630");
            break;
            case "san miguel":
            $("#zip_code").val("1630");
            break;
            case "santa ana":
            $("#zip_code").val("1630");
            break;
            case "tuktukan":
            $("#zip_code").val("1637");
            break;
            case "ususan":
            $("#zip_code").val("1639");
            break;
            case "wawa":
            $("#zip_code").val("1630");
            break;
            case "central bicutan":
            $("#zip_code").val("1631");
            break;
            case "central signal village":
            $("#zip_code").val("1633");
            break;
            case "fort bonifacio":
            $("#zip_code").val("1635");
            break;
            case "katuparan":
            $("#zip_code").val("1630");
            break;
            case "maharlika village":
            $("#zip_code").val("1636");
            break;
            case "north daang hari":
            $("#zip_code").val("1632");
            break;
            case "north signal village":
            $("#zip_code").val("1630");
            break;
            case "pinagsama":
            $("#zip_code").val("1630");
            break;
            case "south daang hari":
            $("#zip_code").val("1632");
            break;
            case "south signal village":
            $("#zip_code").val("1633");
            break;
            case "bagong tanyag":
            $("#zip_code").val("1630");
            break;
            case "upper bicutan":
            $("#zip_code").val("1633");
            break;
            case "western bicutan":
            $("#zip_code").val("1630");
            break;
            default:
            $("#zip_code").val("");
        }
    }); 

    $("#guest_book_barangay").change(function() {
        var barangay = $(this).val();
        
        switch (barangay) {
            case "bagumbayan":
            $("#guest_book_zip_code").val("1630");
            break;
            case "bambang":
            $("#guest_book_zip_code").val("1637");
            break;
            case "calzada":
            $("#guest_book_zip_code").val("1630");
            break;
            case "hagonoy":
            $("#guest_book_zip_code").val("1630");
            break;
            case "ibayo tipas":
            $("#guest_book_zip_code").val("1630");
            break;
            case "ligid tipas":
            $("#guest_book_zip_code").val("1638");
            break;
            case "lower bicutan":
            $("#guest_book_zip_code").val("1632");
            break;
            case "new lower bicutan":
            $("#guest_book_zip_code").val("1632");
            break;
            case "napindan":
            $("#guest_book_zip_code").val("1630");
            break;
            case "palingon":
            $("#guest_book_zip_code").val("1630");
            break;
            case "san miguel":
            $("#guest_book_zip_code").val("1630");
            break;
            case "santa ana":
            $("#guest_book_zip_code").val("1630");
            break;
            case "tuktukan":
            $("#guest_book_zip_code").val("1637");
            break;
            case "ususan":
            $("#guest_book_zip_code").val("1639");
            break;
            case "wawa":
            $("#guest_book_zip_code").val("1630");
            break;
            case "central bicutan":
            $("#guest_book_zip_code").val("1631");
            break;
            case "central signal village":
            $("#guest_book_zip_code").val("1633");
            break;
            case "fort bonifacio":
            $("#guest_book_zip_code").val("1635");
            break;
            case "katuparan":
            $("#guest_book_zip_code").val("1630");
            break;
            case "maharlika village":
            $("#guest_book_zip_code").val("1636");
            break;
            case "north daang hari":
            $("#guest_book_zip_code").val("1632");
            break;
            case "north signal village":
            $("#guest_book_zip_code").val("1630");
            break;
            case "pinagsama":
            $("#guest_book_zip_code").val("1630");
            break;
            case "south daang hari":
            $("#guest_book_zip_code").val("1632");
            break;
            case "south signal village":
            $("#guest_book_zip_code").val("1633");
            break;
            case "bagong tanyag":
            $("#guest_book_zip_code").val("1630");
            break;
            case "upper bicutan":
            $("#guest_book_zip_code").val("1633");
            break;
            case "western bicutan":
            $("#guest_book_zip_code").val("1630");
            break;
            default:
            $("#guest_book_zip_code").val("");
        }
    });      

    $.ajax({
        url: "/api/all-schedule",
        type: "GET",
        dataType: "json",
        success: function(response) {
            var scheduled_times = {};
    
            $.each(response, function(index, value) {
                if (!(value.date in scheduled_times)) {
                    scheduled_times[value.date] = [];
                }
                scheduled_times[value.date].push(value.time);
            });
    
            $('input[name="service_date"]').change(function() {
                var date = $(this).val();
                var times = scheduled_times[date];

                $('#service_time_options input[type="radio"]').prop('disabled', false);
                $('#timeslot_1').removeClass('text-strikethrough');
                $('#timeslot_2').removeClass('text-strikethrough');
                $('#timeslot_3').removeClass('text-strikethrough');
                $('#timeslot_4').removeClass('text-strikethrough');
                $('#timeslot_status_1').text('');
                $('#timeslot_status_2').text('');
                $('#timeslot_status_3').text('');
                $('#timeslot_status_4').text('');

                $.each(times, function(index, value) {
                    $('#service_time_options input[type="radio"][value="' + value + '"]').prop('disabled', true);
                });
    
                $('#service_time_options input[type="radio"]').each(function(index) {
                    var time = $(this).val();
                    if (times.indexOf(time) !== -1) {
                        $(this).prop('disabled', true);
                        $('#timeslot_' + (index+1)).addClass('text-strikethrough');
                        $('#timeslot_status_' + (index+1)).text('Timeslot is filled up!');
                    } else {
                        $(this).prop('disabled', false);
                        $('#timeslot_' + (index+1)).removeClass('text-strikethrough');
                        $('#timeslot_status_' + (index+1)).text('');
                    }
                });   
                
                $('#service_time_options input[type="radio"]:checked').prop('checked', false);
            });

            $('input[name="followup_date"]').change(function() {
                var date = $(this).val();
                var times = scheduled_times[date];

                $('#followup_time_options input[type="radio"]').prop('disabled', false);
                $('#followup_timeslot_1').removeClass('text-strikethrough');
                $('#followup_timeslot_2').removeClass('text-strikethrough');
                $('#followup_timeslot_3').removeClass('text-strikethrough');
                $('#followup_timeslot_4').removeClass('text-strikethrough');
                $('#followup_timeslot_status_1').text('');
                $('#followup_timeslot_status_2').text('');
                $('#followup_timeslot_status_3').text('');
                $('#followup_timeslot_status_4').text('');

                $.each(times, function(index, value) {
                    $('#followup_time_options input[type="radio"][value="' + value + '"]').prop('disabled', true);
                });

                $('#followup_time_options input[type="radio"]').each(function(index) {
                    var time = $(this).val();
                    if (times.indexOf(time) !== -1) {
                        $(this).prop('disabled', true);
                        $('#followup_timeslot_' + (index+1)).addClass('text-strikethrough');
                        $('#followup_timeslot_status_' + (index+1)).text('Timeslot is filled up!');
                    } else {
                        $(this).prop('disabled', false);
                        $('#followup_timeslot_' + (index+1)).removeClass('text-strikethrough');
                        $('#followup_timeslot_status_' + (index+1)).text('');
                    }
                }); 

                $('#followup_time_options input[type="radio"]:checked').prop('checked', false);
            });
        },
        error: function(xhr, status, error) {
            alert(xhr.responseText);
        }
    });

    $.ajax({
        url: "/api/all-customer",
        type: "GET",
        dataType: "json",
        headers: {
            "Authorization": "Bearer " + token
        },
        success: function(response) {
            var select = $("<select>").attr("id", "customer_id").attr("name", "customer_id").addClass("form-control form-control-lg");
            $.each(response, function(index, customer) {
                var option = '<option value="' + customer.id + '">' + customer.last_name.charAt(0).toUpperCase() + customer.last_name.slice(1) + '</option>';
                select.append(option);
            });
            $("#customer-list").append(select);
        }
    });

    $.ajax({
        url: "/api/all-technician",
        type: "GET",
        dataType: "json",
        success: function(response) {
            var technicians = response;
            var technicianCarousel = $("#technician-carousel");
    
            for (var i = 0; i < technicians.length; i++) {
                var technician = technicians[i];
    
                var default_image = technician.image ? technician.image : '/admin/images/faces/default-user.png';
    
                var cardProfile = $("<div>", {
                    "class": "card card-profile"
                });
                var row = $("<div>", {
                    "class": "row"
                });
                var col5 = $("<div>", {
                    "class": "col-md-5"
                });
                var cardImage = $("<div>", {
                    "class": "card-image"
                });
                var img = $("<img>", {
                    "src": default_image,
                    "alt": "",
                    "class": "img"
                });
                var col7 = $("<div>", {
                    "class": "col-md-7"
                });
                var cardBody = $("<div>", {
                    "class": "card-body"
                });
                var title = $("<h3>", {
                    "class": "card-title",
                    "html": technician.first_name + " " + technician.last_name
                });
                var category = $("<h6>", {
                    "class": "category text-primary",
                    "html": technician.role
                });
                var description = $("<p>", {
                    "class": "card-description",
                    "html": "<b>Email: </b><span class='not-text-capitalize'>" +  technician.email + "</span><br><b>Phone Number: </b>" + technician.phone_number + "</span><br><b>Age: </b>" + technician.age + "</span><br><b>Experience: </b>" + technician.experience + "</span><br><b>Specialties: </b>" + technician.specialties   
                });
    
                cardImage.append(img);
                col5.append(cardImage);
                cardBody.append(title, category, description);
                col7.append(cardBody);
                row.append(col5, col7);
                cardProfile.append(row);
                technicianCarousel.append(cardProfile);
            }
    
            technicianCarousel.owlCarousel({
                loop: true,
                margin: 10,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 2
                    },
                    1000: {
                        items: 1
                    }
                }
            });

            var technicianList = $("#technician-list");
            $.each(response, function(index, technician) 
            {
                var checkbox = '<div class="form-check"><label class="form-check-label"><input class="form-check-input" type="checkbox" name="technician_ids[]" value="' + technician.id + '"><span class="form-check-sign"></span>' + technician.last_name.charAt(0).toUpperCase() + technician.last_name.slice(1) + '</label></div>';
                technicianList.append(checkbox);
            });
        }
    });    

    $.ajax({
        url: "/api/all-admin",
        type: "GET",
        dataType: "json",
        success: function(response) {
            var adminList = $("#admin-list");
            $.each(response, function(index, admin) 
            {
                var radio = '<div class="form-check form-check-radio"><label class="form-check-label"><input class="form-check-input" type="radio" id="admin_id" name="admin_id" value="' + admin.id + '"><span class="form-check-sign"></span>' + admin.last_name.charAt(0).toUpperCase() + admin.last_name.slice(1) + '</label></div>';
                adminList.append(radio);
            });
        }
    });    

    $.ajax({
        url: "/api/all-feedback",
        type: "GET",
        dataType: "json",
        success: function(response) {
            var feedbacks = response;
            var feedbackCarousel = $("#feedback-carousel");
    
            for (var i = 0; i < feedbacks.length; i++) {
                function getRatingStars(rating) {
                    var fullStars = Math.round(rating);
                    var emptyStars = 5 - fullStars;
                    
                    var starHtml = "";
                    
                    for (var i = 0; i < fullStars; i++) {
                        starHtml += "<i class='fa fa-star text-primary'></i> ";
                    }
                    
                    for (var j = 0; j < emptyStars; j++) {
                        starHtml += "<i class='far fa-star text-primary'></i> ";
                    }
                    
                    return starHtml.trim();
                }                      

                var feedback = feedbacks[i];
    
                var cardProfile = $("<div>", {
                    "class": "card card-profile"
                });
                var row = $("<div>", {
                    "class": "row"
                });
                var col7 = $("<div>", {
                    "class": "col-md-12"
                });
                var cardBody = $("<div>", {
                    "class": "card-body"
                });
                var title = $("<h3>", {
                    "class": "card-title",
                    "html": "Rating<br>" + getRatingStars(feedback.rating)
                });
                var description = $("<p>", {
                    "class": "card-description",
                    "html": "<b>Customer: </b>" + feedback.customer_full_name + "<br><b>Review: </b>" + feedback.review + "<br><b>Supervisor: </b>" + feedback.admin_last_name + "<br><b>Technicians: </b>" + feedback.technician_last_names
                });
                
                cardBody.append(title, description);
                col7.append(cardBody);
                row.append(col7);
                cardProfile.append(row);
                feedbackCarousel.append(cardProfile);
            }
    
            feedbackCarousel.owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                navText: [
                    "<i class='fa fa-arrow-left text-white'></i>",
                    "<i class='fa fa-arrow-right text-white'></i>"
                ],
                dots: false,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 2
                    },
                    1000: {
                        items: 1
                    }
                }
            });
        }
    });

    if (token) 
    {
        if (expiresAt && new Date().getTime() > expiresAt) {
            removeToken();
            window.location.href = "/login";
        }

        if (expiresAt && (expiresAt - new Date().getTime()) < 5 * 60 * 1000) {
            refreshToken();
        }

        $.ajax({
            url: "/api/profile",
            type: "POST",
            headers: {
                "Authorization": "Bearer " + token,
            },
            success: function(data) {
                let default_image = data.user_data.image ? data.user_data.image : '/admin/images/faces/default-user.png';

                $('#navbar_full_name').text(data.user.full_name);
                $('#navbar_image').attr('src', default_image);
    
                $('#dashboard_name').text(data.user_data.first_name + ' ' + data.user_data.last_name);
                $('#dashboard_image').attr('src', default_image);

                $('#profile_name').text(data.user_data.first_name + ' ' + data.user_data.last_name);
                $('#profile_image').attr('src', default_image);
    
                $('#profile_role').text(data.user.role);
                $('#profile_email').text(data.user.email);
                $('#profile_phone').text(data.user.phone_number);

                if (data.user.email_verified_at) {
                    $('#verify_email').prop('disabled', true);
                    $('#verify_email').text('Verified');
                }                  
    
                if (data.user.role === 'admin') 
                {
                    $('#profile_team').text(data.user_data.team_position);

                    $('#edit_admin_profile').attr('data-id', data.user_data.id);

                    $('#admin_profile').show();
                    $('#technician_profile').hide();
                    $('#customer_profile').hide();
                    $('#super_admin_profile').hide();
                    
                    $('#navbar_book').hide();
                    $('#highlight_book').hide();
                    $('#landing_book').hide();
                    $('#home_book').hide();
                } 
                else if (data.user.role === 'technician') 
                {
                    $('#profile_age').text(data.user_data.age);
                    $('#profile_experience').text(data.user_data.experience);
                    $('#profile_specialties').text(data.user_data.specialties);

                    $('#edit_technician_profile').attr('data-id', data.user_data.id);

                    $('#admin_profile').hide();
                    $('#technician_profile').show();
                    $('#customer_profile').hide();
                    $('#super_admin_profile').hide();

                    $('#navbar_book').hide();
                    $('#highlight_book').hide();
                    $('#landing_book').hide();
                    $('#home_book').hide();
                } 
                else if (data.user.role === 'customer') 
                {
                    if (data.user_data.address) {
                        $('#profile_address').text(data.user_data.address);
                    } else {
                        $('#profile_address').text('Please update your address!').addClass('text-danger');
                    }

                    if (data.user_data.barangay) {
                        $('#profile_barangay').text(data.user_data.barangay);
                    } else {
                        $('#profile_barangay').text('Please update your barangay!').addClass('text-danger');
                    }

                    if (data.user_data.city) {
                        $('#profile_city').text(data.user_data.city);
                    } else {
                        $('#profile_city').text('Please update your city!').addClass('text-danger');
                    }

                    if (data.user_data.province) {
                        $('#profile_province').text(data.user_data.province);
                    } else {
                        $('#profile_province').text('Please update your province!').addClass('text-danger');
                    }

                    if (data.user_data.zip_code) {
                        $('#profile_zip').text(data.user_data.zip_code);
                    } else {
                        $('#profile_zip').text('Please update your zip code!').addClass('text-danger');
                    }

                    if (data.user_data.property_type) {
                        $('#profile_property').text(data.user_data.property_type);
                    } else {
                        $('#profile_property').text('Please update your property type!').addClass('text-danger');
                    }                    

                    $('#first_name').val(data.user_data.first_name);
                    $('#last_name').val(data.user_data.last_name);
                    $('#email').val(data.user.email);
                    $('#phone_number').val(data.user.phone_number);
                    $('#address').val(data.user_data.address);
                    $('#barangay').val(data.user_data.barangay);
                    $('#city').val(data.user_data.city);
                    $('#province').val(data.user_data.province);
                    $('#zip_code').val(data.user_data.zip_code);
                    $('#property_type').val(data.user_data.property_type);  
                    $('#edit_customer_profile').attr('data-id', data.user_data.id);

                    $('#user_book_first_name').val(data.user_data.first_name);
                    $('#user_book_last_name').val(data.user_data.last_name);
                    $('#user_book_email').val(data.user.email);
                    $('#user_book_phone_number').val(data.user.phone_number);
                    $('#user_book_address').val(data.user_data.address);
                    $('#user_book_barangay').val(data.user_data.barangay);
                    $('#user_book_city').val(data.user_data.city);
                    $('#user_book_province').val(data.user_data.province);
                    $('#user_book_zip_code').val(data.user_data.zip_code);
                    $('#user_book_property_type').val(data.user_data.property_type);    

                    $('#admin_profile').hide();
                    $('#technician_profile').hide();
                    $('#customer_profile').show();
                    $('#super_admin_profile').hide();

                    $('#navbar_book').show();
                    $('#highlight_book').show();
                    $('#landing_book').show();
                    $('#home_book').show();
                }
                else
                {
                    $('#profile_team').text(data.user_data.team_position);

                    $('#edit_super_admin_profile').attr('data-id', data.user_data.id);

                    $('#admin_profile').hide();
                    $('#technician_profile').hide();
                    $('#customer_profile').hide();
                    $('#super_admin_profile').show();

                    $('#navbar_book').hide();
                    $('#highlight_book').hide();
                    $('#landing_book').hide();
                    $('#home_book').hide();
                }
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });

        $('#verify_email').on('click', function() {
            $.ajax({
                url: '/api/email/verification-notification',
                type: 'POST',
                headers: {
                    "Authorization": "Bearer " + token
                },
                success: function(response) {
                    alert(response.message);
                },
                error: function(xhr, status, error) {
                    alert(xhr.responseText);
                }
            });
        });

        $("#logout_btn").click(function(event) {
            event.preventDefault();
    
            $.ajax({
                url: "/api/logout",
                type: "POST",
                headers: {
                    "Authorization": "Bearer " + token,
                },
                success: function(response) {
                    alert(response.message);
                    localStorage.removeItem("access_token");
                    localStorage.removeItem("access_token_expires_at");
                    window.location.href = "/";
                },
                error: function(xhr, status, error) {
                    alert(xhr.responseText);
                }
            });
        });

        $("#book_btn").click(function(event){
            event.preventDefault();

            var imageFile = $('#image')[0].files[0];

            var formData = new FormData();

            if (imageFile) {
                formData.append('image', imageFile);
            }
    
            formData.append('service_type', $('#service_type').val());
            formData.append('ac_type', $('#ac_type').val());
            if ($('#ac_brand').val() === "other") {
                formData.append('ac_brand', $('#other_brand').val());
            } 
            else {
                formData.append('ac_brand', $('#ac_brand').val());
            }
            formData.append('ac_hp', $('#ac_hp').val());
            formData.append('unit_type', $('#unit_type').val());
            formData.append('no_unit', $('#no_unit').val());
            formData.append('description', $('#description').val());
            formData.append('cooling', $('input[name=cooling]:checked').val());
            formData.append('mechanical_noise', $('input[name=mechanical_noise]:checked').val());
            formData.append('electric_connectivity', $('input[name=electric_connectivity]:checked').val());
            formData.append('service_date', $('#service_date').val());
            formData.append('service_time', $('input[name=service_time]:checked').val());
            formData.append('service_price', $('#service_price').val());
            formData.append('payment_method', $('#payment_method').val());
            formData.append('notes', $('#notes').val());
            formData.append('amount', $('#amount').val());
            formData.append('voucher_id', $('#voucher_id').val());
            formData.append('admin_id', ($('input[name=admin_id]:checked').val() !== undefined) ? $('input[name=admin_id]:checked').val() : '');
    
            $.ajax({
                url: "/api/services",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    "Authorization": "Bearer " + token,
                },
                success: function(response) {
                    window.location.href = "/booking-successful";
                },
                error: function(xhr, status, error) {
                    alert(xhr.responseText);
                }
            });
        });

        $("#walkin_btn").click(function(event){
            event.preventDefault();

            var imageFile = $('#image')[0].files[0];

            var paymentProof = $('#payment_proof')[0].files[0];

            var formData = new FormData();

            if (imageFile) {
                formData.append('image', imageFile);
            }

            if (paymentProof) {
                formData.append('payment_proof', paymentProof);
            }
    
            formData.append('customer_id', $('#customer_id').val());
            formData.append('service_type', $('#service_type').val());
            formData.append('book_type', 'walk-in');
            formData.append('ac_type', $('#ac_type').val());
            if ($('#ac_brand').val() === "other") {
                formData.append('ac_brand', $('#other_brand').val());
            } 
            else {
                formData.append('ac_brand', $('#ac_brand').val());
            }
            formData.append('ac_hp', $('#ac_hp').val());
            formData.append('unit_type', $('#unit_type').val());
            formData.append('no_unit', $('#no_unit').val());
            formData.append('description', $('#description').val());
            formData.append('cooling', $('input[name=cooling]:checked').val());
            formData.append('mechanical_noise', $('input[name=mechanical_noise]:checked').val());
            formData.append('electric_connectivity', $('input[name=electric_connectivity]:checked').val());
            formData.append('service_date', $('#service_date').val());
            formData.append('service_time', $('input[name=service_time]:checked').val());
            formData.append('service_price', $('#service_price').val());
            formData.append('payment_method', $('#payment_method').val());
            formData.append('notes', $('#notes').val());
            formData.append('amount', $('#amount').val());
            formData.append('voucher_id', $('#voucher_id').val());
            formData.append('admin_id', ($('input[name=admin_id]:checked').val() !== undefined) ? $('input[name=admin_id]:checked').val() : '');
    
            $.ajax({
                url: "/api/walkin-services",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    "Authorization": "Bearer " + token,
                },
                success: function(response) {
                    window.location.href = "/walkin-successful";
                },
                error: function(xhr, status, error) {
                    alert(xhr.responseText);
                }
            });
        });

        $('#edit_password').on('click', function() {
        
            var form_data = $("#edit_password_form").serialize();
    
            $.ajax({
                url: "/api/change-password",
                type: 'PUT',
                headers: {
                    "Authorization": "Bearer " + token
                },
                data: form_data,
                success: function(response) {
                    alert(response.message);
                    location.reload();
                },
                error: function(xhr, status, error) {
                    alert(xhr.responseText);
                }
            });
        });

        $('#navbar_login').hide();
        $('#navbar_register').hide();
        $('#navbar_full_name_display').show();
        $('#navbar_image_display').show();
        $('#guest_customer_info').hide();
        $('#user_customer_info').show();
    } 
    else
    {
        $("#register_form").submit(function(event){
            event.preventDefault();
    
            var register_data = {
                'first_name' : $('#first_name').val(),
                'last_name' : $('#last_name').val(),
                'email' : $('#email').val(),
                'phone_number' : $('#phone').val() + $('#number').val(),
                'password' : $('#password').val(),
                'password_confirmation' : $('#password-confirm').val()
            };
    
            $.ajax({
                url: "/api/register",
                type: "POST",
                data: register_data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    "Accept": "application/json"
                },
                success:function(response){
                    alert(response.message);
                    window.location.href = "/login";
                },
                error: function(xhr, status, error) {
                    alert(xhr.responseText);
                }
            });
        });
    
        $("#login_form").submit(function(event){
            event.preventDefault();
    
            var form_data = $("#login_form").serialize();
    
            $.ajax({
                url: "/api/login",
                type: "POST",
                data: form_data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    "Accept": "application/json"
                },
                success: function(data) {
                    localStorage.setItem("access_token", data.access_token);
                    var expiresAt = new Date().getTime() + data.expires_in * 1000;
                    localStorage.setItem("access_token_expires_at", expiresAt);

                    if (data.user.role === 'admin') 
                    {
                        window.location.href = "/admin-profile";
                    }
                    else if (data.user.role === 'technician')
                    {
                        window.location.href = "/technician-profile";
                    }
                    else if (data.user.role === 'customer')
                    {
                        window.location.href = "/customer-profile";
                    }
                    else
                    {
                        window.location.href = "/super-admin-profile";
                    }
                },
                error: function(xhr, status, error) {
                    alert(xhr.responseText);
                }
            });
        });

        $("#book_btn").click(function(event){
            event.preventDefault();

            var imageFile = $('#image')[0].files[0];

            var formData = new FormData();

            if (imageFile) {
                formData.append('image', imageFile);
            }
    
            formData.append('first_name', $('#guest_book_first_name').val());
            formData.append('last_name', $('#guest_book_last_name').val());
            formData.append('email', $('#guest_book_email').val());
            formData.append('password', $('#guest_book_password').val());
            formData.append('password_confirmation', $('#guest_book_password_confirmation').val());
            formData.append('phone_number', $('#guest_book_phone_number').val());
            formData.append('address', $('#guest_book_address').val());
            formData.append('barangay', $('#guest_book_barangay').val());
            formData.append('city', $('#guest_book_city').val());
            formData.append('province', $('#guest_book_province').val());
            formData.append('zip_code', $('#guest_book_zip_code').val());
            formData.append('property_type', $('#guest_book_property_type').val());
            formData.append('service_type', $('#service_type').val());
            formData.append('ac_type', $('#ac_type').val());
            if ($('#ac_brand').val() === "other") {
                formData.append('ac_brand', $('#other_brand').val());
            } 
            else {
                formData.append('ac_brand', $('#ac_brand').val());
            }
            formData.append('ac_hp', $('#ac_hp').val());
            formData.append('unit_type', $('#unit_type').val());
            formData.append('no_unit', $('#no_unit').val());
            formData.append('description', $('#description').val());
            formData.append('cooling', $('input[name=cooling]:checked').val());
            formData.append('mechanical_noise', $('input[name=mechanical_noise]:checked').val());
            formData.append('electric_connectivity', $('input[name=electric_connectivity]:checked').val());
            formData.append('service_date', $('#service_date').val());
            formData.append('service_time', $('input[name=service_time]:checked').val());
            formData.append('service_price', $('#service_price').val());
            formData.append('payment_method', $('#payment_method').val());
            formData.append('notes', $('#notes').val());
            formData.append('amount', $('#amount').val());
            formData.append('voucher_id', $('#voucher_id').val());
            formData.append('admin_id', ($('input[name=admin_id]:checked').val() !== undefined) ? $('input[name=admin_id]:checked').val() : '');

            $.ajax({
                url: "/api/guest-services",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function(data) {
                    localStorage.setItem("access_token", data.access_token);
                    var expiresAt = new Date().getTime() + data.expires_in * 1000;
                    localStorage.setItem("access_token_expires_at", expiresAt);
                    window.location.href = "/booking-successful";
                },
                error: function(xhr, status, error) {
                    alert(xhr.responseText);
                }
            });
        });

        $("#forgot_form").submit(function(event){
            event.preventDefault();
    
            var form_data = $("#forgot_form").serialize();
    
            $.ajax({
                url: "/api/forgot-password",
                type: "POST",
                data: form_data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    "Accept": "application/json"
                },
                success: function(response) {
                    alert(response.message);
                    $('#forgot_form').trigger('reset');
                },
                error: function(xhr, status, error) {
                    alert(xhr.responseText);
                }
            });
        });

        $("#reset_form").submit(function(event){
            event.preventDefault();
    
            var form_data = $("#reset_form").serialize();
    
            $.ajax({
                url: "/api/reset-password",
                type: "POST",
                data: form_data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    "Accept": "application/json"
                },
                success: function(response) {
                    alert(response.message);
                    $('#reset_form').trigger('reset');
                    window.location.href = "/login";
                },
                error: function(xhr, status, error) {
                    alert(xhr.responseText);
                }
            });
        });

        $('#navbar_login').show();
        $('#navbar_register').show();
        $('#navbar_full_name_display').hide();
        $('#navbar_image_display').hide();
        $('#guest_customer_info').show();
        $('#user_customer_info').hide();
    }

    function removeToken() {
        localStorage.removeItem('access_token');
        localStorage.removeItem('access_token_expires_at');
    }

    function refreshToken() {
        $.ajax({
            url: "/api/refresh",
            type: "POST",
            headers: {
                'Authorization': 'Bearer ' + token,
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                "Accept": "application/json"
            },
            success: function(data) {
                localStorage.setItem("access_token", data.access_token);
                var expiresAt = new Date().getTime() + data.expires_in * 1000;
                localStorage.setItem("access_token_expires_at", expiresAt);
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    }

    $("#contact_form").submit(function(event){
        event.preventDefault();

        var form_data = $("#contact_form").serialize();

        $.ajax({
            url: "/api/email",
            type: "POST",
            data: form_data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                "Accept": "application/json"
            },
            success: function(response) {
                alert(response.message);
                $('#contact_form').trigger('reset');
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });
});