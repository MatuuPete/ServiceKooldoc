$(document).ready(function (){
    const token = localStorage.getItem('access_token');

    document.getElementById('link_profile').setAttribute('href', '/customer-profile');

    $('#other_why_option').hide();

    $('input[name="why"]').change(function() {
        if ($(this).val() === 'other') 
        {
            $('#other_why_option').show();
        } 
        else 
        {
            $('#other_why_option').hide();
        }
    });

    $('#booked_services').DataTable({
        dom: 'Blfrtip', 
        buttons: [
            'excel',
            'csv',
            'pdf',
            'copy'
        ],
        ajax: 
        {
            url :"/api/booked-services",
            type: "GET",
            headers: {
                "Authorization": "Bearer " + token
            },
            dataSrc: "",
        },
        responsive: true,
        columns: [      
            { "data": "id" },
            { "data": "technician_last_names" },
            { "data": "admin_last_name" },
            { 
                "data": "admin_contact",
                "render": function(data, type, full, meta) 
                {
                    return "<span class='not-text-capitalize'>" + data + "</span>";
                } 
            },
            { "data": "book_type" },
            { "data": "service_type" },
            { "data": "ac_type" },
            { "data": "ac_brand" },
            { "data": "ac_hp" },
            { "data": "unit_type" },
            { "data": "no_unit" },
            { "data": "description" },
            { 
                data: 'image',
                render: function (data, type, row) 
                {
                    if (data) 
                    {
                        return '<a href="' + data + '" data-fancybox="ac-image" data-caption="AC Image">' + '<img src="' + data + '">' + '</a>';
                    } else
                    {
                        return '';
                    }
                }
            },
            { "data": "cooling" },
            { "data": "mechanical_noise" },
            { "data": "electric_connectivity" },
            { "data": "service_date" },
            { "data": "service_time" },
            { "data": "service_price" },
            { "data": "service_status" },
            {
                "data": null,
                "render": function(data, type, row) {
                    var serviceDate = new Date(row.service_date);
                    var twentyFourHoursBeforeService = new Date(serviceDate.getTime() - 24 * 60 * 60 * 1000);
                    var now = new Date();
                
                    if (now < twentyFourHoursBeforeService) 
                    {
                        return `<button class="btn btn-danger" id="cancel_service" data-bs-toggle="modal" data-bs-target="#addCancelModal" data-id="${row.id}">
                                    <i class="mdi mdi-cancel"></i>
                                </button>`;
                    } 
                    else 
                    {
                        return ``;
                    }
                }                           
            },
        ],
    });

    $('#addCancelModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var service_id = button.data('id'); 
        var modal = $(this);
        modal.find('#service_id').val(service_id);
    });

    $('#add_cancel').on('click', function() {
        
        var service_id =  $('#service_id').val();

        var cancel_data = {
            'why': $('input[name="why"]:checked').val(),
        };
        
        if (cancel_data.why === 'other') {
            cancel_data.why = $('[name="other_why"]').val();
        } 

        $.ajax({
            url: "/api/cancel-services/" + service_id,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                "Authorization": "Bearer " + token
            },
            data: cancel_data,
            success: function(response) {
                alert(response.message);
                $('#addCancelModal').modal('hide');
                $('#cancel_form').trigger('reset');
                $('#booked_services').DataTable().ajax.reload();
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    $('#finished_booked_service').DataTable({
        dom: 'Blfrtip',
        buttons: [
            'excel',
            'csv',
            'pdf',
            'copy'
        ],
        ajax: 
        {
            url :"/api/finished-booked-service",
            type: "GET",
            headers: {
                "Authorization": "Bearer " + token
            },
            dataSrc: "",
        },
        responsive: true,
        columns: [
            { "data": "id" },
            { "data": "technician_last_names" },
            { "data": "admin_last_name" },
            { 
                "data": "admin_contact",
                "render": function(data, type, full, meta) 
                {
                    return "<span class='not-text-capitalize'>" + data + "</span>";
                } 
            },
            { "data": "book_type" },
            { "data": "service_type" },
            { "data": "ac_type" },
            { "data": "ac_brand" },
            { "data": "ac_hp" },
            { "data": "unit_type" },
            { "data": "no_unit" },
            { "data": "description" },
            { 
                data: 'image',
                render: function (data, type, row) 
                {
                    if (data) 
                    {
                        return '<a href="' + data + '" data-fancybox="ac-image" data-caption="AC Image">' + '<img src="' + data + '">' + '</a>';
                    } else
                    {
                        return '';
                    }
                }
            },
            { "data": "cooling" },
            { "data": "mechanical_noise" },
            { "data": "electric_connectivity" },
            { "data": "service_date" },
            { "data": "service_time" },
            { "data": "service_price" },
            { 
                data: 'service_report',
                render: function (data, type, row) 
                {
                    if (data) 
                    {
                        return '<a href="' + data + '" data-fancybox="service-report" data-caption="Service Report">' + '<img src="' + data + '">' + '</a>';
                    } else
                    {
                        return '';
                    }
                }
            },
            { "data": "service_status" },
        ]
    });
    
    $('#completed_booked_service').DataTable({
        dom: 'Blfrtip',
        buttons: [
            'excel',
            'csv',
            'pdf',
            'copy'
        ],
        ajax: 
        {
            url :"/api/completed-booked-service",
            type: "GET",
            headers: {
                "Authorization": "Bearer " + token
            },
            dataSrc: "",
        },
        responsive: true,
        columns: [
            { "data": "id" },
            { "data": "technician_last_names" },
            { "data": "admin_last_name" },
            { 
                "data": "admin_contact",
                "render": function(data, type, full, meta) 
                {
                    return "<span class='not-text-capitalize'>" + data + "</span>";
                } 
            },
            { "data": "book_type" },
            { "data": "service_type" },
            { "data": "ac_type" },
            { "data": "ac_brand" },
            { "data": "ac_hp" },
            { "data": "unit_type" },
            { "data": "no_unit" },
            { "data": "description" },
            { 
                data: 'image',
                render: function (data, type, row) 
                {
                    if (data) 
                    {
                        return '<a href="' + data + '" data-fancybox="ac-image" data-caption="AC Image">' + '<img src="' + data + '">' + '</a>';
                    } else
                    {
                        return '';
                    }
                }
            },
            { "data": "cooling" },
            { "data": "mechanical_noise" },
            { "data": "electric_connectivity" },
            { "data": "service_date" },
            { "data": "service_time" },
            { "data": "service_price" },
            { 
                data: 'service_report',
                render: function (data, type, row) 
                {
                    if (data) 
                    {
                        return '<a href="' + data + '" data-fancybox="service-report" data-caption="Service Report">' + '<img src="' + data + '">' + '</a>';
                    } else
                    {
                        return '';
                    }
                }
            },
            { "data": "service_status" },
            { 
                "data": null,
                render: function(data, type, row) 
                {
                    if (row.feedback_id != null) 
                    {
                        return '';
                    } 
                    else 
                    {
                        return `<button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addFeedbackModal" data-id="${row.id}"><i class="mdi mdi-star"></i></button>`;
                    }
                }
            },
            { 
                "data": null,
                "render": function(data, type, row) 
                {
                    var now = new Date();
                    var service_date = new Date(row.service_date);
                    var seven_days_ago = new Date(now.getFullYear(), now.getMonth(), now.getDate() - 6);
                    if (service_date < seven_days_ago && row.service_status == 'completed') 
                    {
                        if (row.post_consultation_id != null) 
                        {
                            return '';
                        } 
                        else 
                        {
                            return `<button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addPostConsultationModal" data-id="${row.id}"><i class="mdi mdi-comment"></i></button>`;
                        } 
                    } 
                    else 
                    {
                        return ``;
                    }
                }
            },
        ],
    });

    $('#addFeedbackModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var service_id = button.data('id'); 
        var modal = $(this);
        modal.find('#service_id').val(service_id);
    });

    $('#add_feedback').on('click', function() {
        
        var feedback_data = {
            'service_id' : $('#service_id').val(),
            'rating' : $('input[name=rating]:checked').val(),
            'review' : $('#review').val(),
        }

        $.ajax({
            url: '/api/feedbacks',
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                "Authorization": "Bearer " + token
            },
            data: feedback_data,
            success: function(response) {
                alert(response.message);
                $('#addFeedbackModal').modal('hide');
                $('#feedback_form').trigger('reset');
                $('#completed_booked_service').DataTable().ajax.reload();
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    $('#addPostConsultationModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var service_id = button.data('id'); 
        var modal = $(this);
        modal.find('#service_id2').val(service_id);
    });

    $('#add_post_consultation').on('click', function() {
        
        var post_consultation_data = {
            'service_id' : $('#service_id2').val(),
            'message' : $('#message').val(),
        }

        $.ajax({
            url: '/api/post-consultations',
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                "Authorization": "Bearer " + token
            },
            data: post_consultation_data,
            success: function(response) {
                alert(response.message);
                $('#addPostConsultationModal').modal('hide');
                $('#post_consultation_form').trigger('reset');
                $('#completed_booked_service').DataTable().ajax.reload();
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    $('#follow_up_booked_service').DataTable({
        dom: 'Blfrtip',
        buttons: [
            'excel',
            'csv',
            'pdf',
            'copy'
        ],
        ajax: 
        {
            url :"/api/follow-up-booked-service",
            type: "GET",
            headers: {
                "Authorization": "Bearer " + token
            },
            dataSrc: "",
        },
        responsive: true,
        columns: [
            { "data": "service_id" },
            { "data": "id" },
            { "data": "technician_last_names" },
            { "data": "admin_last_name" },
            { 
                "data": "admin_contact",
                "render": function(data, type, full, meta) 
                {
                    return "<span class='not-text-capitalize'>" + data + "</span>";
                } 
            },
            { "data": "reason" },
            { "data": "followup_date" },
            { "data": "followup_time" },
            { "data": "followup_status" },
        ]
    });

    $('#finished_followup_booked_service').DataTable({
        dom: 'Blfrtip',
        buttons: [
            'excel',
            'csv',
            'pdf',
            'copy'
        ],
        ajax: 
        {
            url :"/api/finished-followup-booked-service",
            type: "GET",
            headers: {
                "Authorization": "Bearer " + token
            },
            dataSrc: "",
        },
        responsive: true,
        columns: [
            { "data": "service_id" },
            { "data": "id" },
            { "data": "technician_last_names" },
            { "data": "admin_last_name" },
            { 
                "data": "admin_contact",
                "render": function(data, type, full, meta) 
                {
                    return "<span class='not-text-capitalize'>" + data + "</span>";
                } 
            },
            { "data": "reason" },
            { "data": "followup_date" },
            { "data": "followup_time" },
            { 
                data: 'followup_report',
                render: function (data, type, row) 
                {
                    if (data) 
                    {
                        return '<a href="' + data + '" data-fancybox="followup-report" data-caption="Follow-up Report">' + '<img src="' + data + '">' + '</a>';
                    } else
                    {
                        return '';
                    }
                }
            },
            { "data": "followup_status" },
        ]
    });

    $('#completed_followup_booked_service').DataTable({
        dom: 'Blfrtip',
        buttons: [
            'excel',
            'csv',
            'pdf',
            'copy'
        ],
        ajax: 
        {
            url :"/api/completed-followup-booked-service",
            type: "GET",
            headers: {
                "Authorization": "Bearer " + token
            },
            dataSrc: "",
        },
        responsive: true,
        columns: [
            { "data": "service_id" },
            { "data": "id" },
            { "data": "technician_last_names" },
            { "data": "admin_last_name" },
            { 
                "data": "admin_contact",
                "render": function(data, type, full, meta) 
                {
                    return "<span class='not-text-capitalize'>" + data + "</span>";
                } 
            },
            { "data": "reason" },
            { "data": "followup_date" },
            { "data": "followup_time" },
            { 
                data: 'followup_report',
                render: function (data, type, row) 
                {
                    if (data) 
                    {
                        return '<a href="' + data + '" data-fancybox="followup-report" data-caption="Follow-up Report">' + '<img src="' + data + '">' + '</a>';
                    } else
                    {
                        return '';
                    }
                }
            },
            { "data": "followup_status" },
            { 
                "data": null,
                render: function(data, type, row) {
                    if (row.feedback_id != null) 
                    {
                        return '';
                    } 
                    else 
                    {
                        return `<button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addFeedback2Modal" data-id="${row.service_id}"><i class="mdi mdi-star"></i></button>`;
                    }
                }
            },
            { 
                "data": null,
                "render": function(data, type, row) {
                    var now = new Date();
                    var followup_date = new Date(row.followup_date);
                    var seven_days_ago = new Date(now.getFullYear(), now.getMonth(), now.getDate() - 6);
                    if (followup_date < seven_days_ago && row.followup_status == 'completed') 
                    {
                        if (row.post_consultation_id != null) 
                        {
                            return '';
                        } 
                        else 
                        {
                            return `<button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addPostConsultation2Modal" data-id="${row.service_id}"><i class="mdi mdi-comment"></i></button>`;
                        }
                    } 
                    else 
                    {
                        return ``;
                    }
                }
            },
        ],
    });

    $('#addFeedback2Modal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var service_id = button.data('id'); 
        var modal = $(this);
        modal.find('#service_id').val(service_id);
    });

    $('#add_feedback2').on('click', function() {
        
        var feedback_data = {
            'service_id' : $('#service_id').val(),
            'rating' : $('input[name=rating]:checked').val(),
            'review' : $('#review').val(),
        }

        $.ajax({
            url: '/api/feedbacks',
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                "Authorization": "Bearer " + token
            },
            data: feedback_data,
            success: function(response) {
                alert(response.message);
                $('#addFeedback2Modal').modal('hide');
                $('#feedback_form').trigger('reset');
                $('#completed_followup_booked_service').DataTable().ajax.reload();
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    $('#addPostConsultation2Modal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var service_id = button.data('id'); 
        var modal = $(this);
        modal.find('#service_id2').val(service_id);
    });

    $('#add_post_consultation2').on('click', function() {
        
        var post_consultation_data = {
            'service_id' : $('#service_id2').val(),
            'message' : $('#message').val(),
        }

        $.ajax({
            url: '/api/post-consultations',
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                "Authorization": "Bearer " + token
            },
            data: post_consultation_data,
            success: function(response) {
                alert(response.message);
                $('#addPostConsultation2Modal').modal('hide');
                $('#post_consultation_form').trigger('reset');
                $('#completed_followup_booked_service').DataTable().ajax.reload();
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    $('#cancelled_service').DataTable({
        dom: 'Blfrtip',
        buttons: [
            'excel',
            'csv',
            'pdf',
            'copy'
        ],
        ajax: 
        {
            url :"/api/cancelled-service",
            type: "GET",
            headers: {
                "Authorization": "Bearer " + token
            },
            dataSrc: "",
        },
        responsive: true,
        columns: [
            { "data": "id" },
            { "data": "why" },
            { "data": "book_type" },
            { "data": "service_type" },
            { "data": "ac_type" },
            { "data": "ac_brand" },
            { "data": "unit_type" },
            { "data": "no_unit" },
            { "data": "description" },
            { 
                data: 'image',
                render: function (data, type, row) 
                {
                    if (data) 
                    {
                        return '<a href="' + data + '" data-fancybox="ac-image" data-caption="AC Image">' + '<img src="' + data + '">' + '</a>';
                    } else
                    {
                        return '';
                    }
                }
            },
            { "data": "cooling" },
            { "data": "mechanical_noise" },
            { "data": "electric_connectivity" },
            { "data": "service_price" },
            { "data": "service_status" },
        ]
    });

    $('#service_feedback').DataTable({
        dom: 'Blfrtip',
        buttons: [
            'excel',
            'csv',
            'pdf',
            'copy'
        ],
        ajax: 
        {
            url :"/api/service-feedback",
            type: "GET",
            headers: {
                "Authorization": "Bearer " + token
            },
            dataSrc: "",
        },
        responsive: true,
        columns: [
            { "data": "service_id" },
            { "data": "technician_last_names" },
            { "data": "admin_last_name" },
            { 
                "data": "admin_contact",
                "render": function(data, type, full, meta) 
                {
                    return "<span class='not-text-capitalize'>" + data + "</span>";
                } 
            },
            { "data": "rating" },
            { "data": "review" },
            { 
                "data": null,
                render: function(data, type, row) {
                    var createdDate = new Date(row.created_at);

                    var currentDate = new Date();

                    var differenceInMilliseconds = currentDate - createdDate;

                    var differenceInDays = differenceInMilliseconds / (1000 * 60 * 60 * 24);

                    if (differenceInDays >= 30) 
                    {
                        return `<button class="btn btn-primary edit-feedback" data-bs-toggle="modal" data-bs-target="#editFeedbackModal" data-id="${row.id}"><i class="mdi mdi-pencil"></i></button>`;
                    } 
                    else 
                    {
                        return '';
                    }
                }
            },
        ]
    });

    $(document).on('click', '.edit-feedback', function() {
        var id = $(this).data('id');
        $.ajax({
            url: '/api/feedbacks/' + id,
            type: 'GET',
            headers: {
                "Authorization": "Bearer " + token
            },
            success: function(feedback) {
                $('#service_id').val(feedback.service_id);
                $('input[name=rating][value="' + feedback.rating + '"]').prop('checked', true);
                $('#review').val(feedback.review);
                $('#edit_feedback').attr('data-id', feedback.id);
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });
    
    $('#edit_feedback').on('click', function() {
        var id = $(this).attr('data-id');
        var feedback_data = {
            'service_id' : $('#service_id').val(),
            'rating' : $('input[name=rating]:checked').val(),
            'review' : $('#review').val(),
        }
    
        $.ajax({
            url: '/api/feedbacks/' + id,
            type: 'PUT',
            headers: {
                "Authorization": "Bearer " + token
            },
            data: feedback_data,
            success: function(response) {
                alert(response.message);
                $('#editFeedbackModal').modal('hide');
                $('#feedback_form').trigger('reset');
                $('#service_feedback').DataTable().ajax.reload();
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    $('#service_post_consultation').DataTable({
        dom: 'Blfrtip',
        buttons: [
            'excel',
            'csv',
            'pdf',
            'copy'
        ],
        ajax: 
        {
            url :"/api/service-post-consultation",
            type: "GET",
            headers: {
                "Authorization": "Bearer " + token
            },
            dataSrc: "",
        },
        responsive: true,
        columns: [
            { "data": "service_id" },
            { "data": "technician_last_names" },
            { "data": "admin_last_name" },
            { 
                "data": "admin_contact",
                "render": function(data, type, full, meta) 
                {
                    return "<span class='not-text-capitalize'>" + data + "</span>";
                } 
            },
            { "data": "message" },
            { "data": "recommendation" },
            { "data": "consultation_date" },
            { "data": "consultation_status" },
            { 
                "data": null,
                render: function(data, type, row) {
                    if (row.consultation_status == 'read') 
                        {
                            return '';
                        } 
                    else
                    {
                        return `<button class="btn btn-primary edit-post-consultation" data-bs-toggle="modal" data-bs-target="#editPostConsultationModal" data-id="${row.id}"><i class="mdi mdi-pencil"></i></button>`;
                    }
                }
            },
        ]
    });

    $(document).on('click', '.edit-post-consultation', function() {
        var id = $(this).data('id');
        $.ajax({
            url: '/api/post-consultations/' + id,
            type: 'GET',
            headers: {
                "Authorization": "Bearer " + token
            },
            success: function(post_consultation) {
                $('#service_id').val(post_consultation.service_id);
                $('#message').val(post_consultation.message);
                $('#edit_post_consultation').attr('data-id', post_consultation.id);
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    $('#edit_post_consultation').on('click', function() {
        var id = $(this).attr('data-id');
        var post_consultation_data = {
            'message' : $('#message').val(),
        }
    
        $.ajax({
            url: '/api/post-consultations/' + id,
            type: 'PUT',
            headers: {
                "Authorization": "Bearer " + token
            },
            data: post_consultation_data,
            success: function(response) {
                alert(response.message);
                $('#editPostConsultationModal').modal('hide');
                $('#post_consultation_form').trigger('reset');
                $('#service_post_consultation').DataTable().ajax.reload();
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    $('#service_warranty').DataTable({
        dom: 'Blfrtip',
        buttons: [
            'excel',
            'csv',
            'pdf',
            'copy'
        ],
        ajax: 
        {
            url :"/api/service-warranty",
            type: "GET",
            headers: {
                "Authorization": "Bearer " + token
            },
            dataSrc: "",
        },
        responsive: true,
        columns: [
            { "data": "service_id" },
            { "data": "id" },
            { "data": "warranty_type" },
            { "data": "period" },
            { "data": "start_date" },
            { "data": "end_date" },
            { "data": "warranty_status" },
            { 
                "data": null,
                render: function(data, type, row) {
                    if (row.warranty_status === 'voided' || row.warranty_status === 'expired' || row.warranty_claim_id != null) 
                    {
                        return '';
                    } 
                    else 
                    {
                        return `<button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addWarrantyClaimModal" data-id="${row.id}"><i class="mdi mdi-seal"></i></button>`;
                    }
                }
            },
        ]
    });

    $('#addWarrantyClaimModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var warranty_id = button.data('id'); 
        var modal = $(this);
        modal.find('#warranty_id').val(warranty_id);
    });

    $('#add_warranty_claim').on('click', function() {
        
        var warranty_claim_data = {
            'warranty_id' : $('#warranty_id').val(),
            'statement' : $('#statement').val(),
        }

        $.ajax({
            url: '/api/warranty-claims',
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                "Authorization": "Bearer " + token
            },
            data: warranty_claim_data,
            success: function(response) {
                alert(response.message);
                $('#addWarrantyClaimModal').modal('hide');
                $('#warranty_claim_form').trigger('reset');
                $('#service_warranty').DataTable().ajax.reload();
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    $('#warranty_claim').DataTable({
        dom: 'Blfrtip',
        buttons: [
            'excel',
            'csv',
            'pdf',
            'copy'
        ],
        ajax: 
        {
            url :"/api/warranty-claim",
            type: "GET",
            headers: {
                "Authorization": "Bearer " + token
            },
            dataSrc: "",
        },
        responsive: true,
        columns: [
            { "data": "service_id" },
            { "data": "id" },
            { "data": "warranty_id" },
            { "data": "claim_date" },
            { "data": "statement" },
            { "data": "claim_status" },
        ]
    });

    $('#transaction_histories').DataTable({
        dom: 'Blfrtip',
        buttons: [
            'excel',
            'csv',
            'pdf',
            'copy'
        ],
        ajax: 
        {
            url :"/api/transaction-histories",
            type: "GET",
            headers: {
                "Authorization": "Bearer " + token
            },
            dataSrc: "",
        },
        responsive: true,
        columns: [
            { "data": "id" },
            { "data": "service_id" },
            { "data": "service_price" },
            { "data": "voucher_id" },
            { "data": "discount" },
            { "data": "payment_method" },
            { "data": "amount" },
            {
                data: 'payment_proof',
                render: function (data, type, row) 
                {
                    if (data) 
                    {
                        return '<a href="' + data + '" data-fancybox="payment-proof" data-caption="Payment Proof">' + '<img src="' + data + '">' + '</a>';
                    } else
                    {
                        return '';
                    }
                }
            },            
            { "data": "notes" },
            { "data": "transaction_date" },
            { "data": "transaction_status"},
            {
                data: null,
                render: function (data, type, row) 
                {
                    if (row.payment_proof != null && (row.transaction_status == 'failed' || row.transaction_status == 'success'))
                    {
                        return ``;
                    }
                    else if (row.payment_proof != null)
                    {
                        return `<button class="btn btn-primary edit-transaction-history" data-bs-toggle="modal" data-bs-target="#editTransactionHistoryModal" data-id="${row.id}"><i class="mdi mdi-pencil"></i></button>`;
                    }
                    else
                    {
                        return `<button class="btn btn-success edit-transaction-history" data-bs-toggle="modal" data-bs-target="#editTransactionHistoryModal" data-id="${row.id}"><i class="mdi mdi-plus"></i></button>`;
                    }
                }
            },
        ]
    });

    $(document).on('click', '.edit-transaction-history', function() {
        var id = $(this).data('id');
        $.ajax({
            url: '/api/transactions/' + id,
            type: 'GET',
            headers: {
                "Authorization": "Bearer " + token
            },
            success: function(transaction_history) {
                $('#transaction_id').val(transaction_history.id);
                $('#transaction_history_payment_method').val(transaction_history.payment_method);
                $('#edit_transaction_history').attr('data-id', transaction_history.id);
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    $('#edit_transaction_history').on('click', function() {
        var id = $(this).attr('data-id');

        var paymentProofFile = $('#payment_proof')[0].files[0];

        var formData = new FormData();

        if (paymentProofFile) {
            formData.append('payment_proof', paymentProofFile);
        }

        formData.append('payment_method', $('#transaction_history_payment_method').val());
        var today = new Date();
        var formattedDate = today.toISOString().substring(0, 10);
        formData.append('transaction_date', formattedDate);
        formData.append('transaction_status', 'processing');
    
        $.ajax({
            url: '/api/transactions/' + id,
            type: 'POST',
            headers: {
                "Authorization": "Bearer " + token
            },
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                alert(response.message);
                $('#editTransactionHistoryModal').modal('hide');
                $('#transaction_history_form').trigger('reset');
                $('#transaction_histories').DataTable().ajax.reload();
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    $('#cancelled_transaction_history').DataTable({
        dom: 'Blfrtip',
        buttons: [
            'excel',
            'csv',
            'pdf',
            'copy'
        ],
        ajax: 
        {
            url :"/api/cancelled-transaction-history",
            type: "GET",
            headers: {
                "Authorization": "Bearer " + token
            },
            dataSrc: "",
        },
        responsive: true,
        columns: [
            { "data": "id" },
            { "data": "service_id" },
            { "data": "service_price" },
            { "data": "voucher_id" },
            { "data": "discount" },
            { "data": "payment_method" },
            { "data": "amount" },
            {
                data: 'payment_proof',
                render: function (data, type, row) 
                {
                    if (data) 
                    {
                        return '<a href="' + data + '" data-fancybox="payment-proof" data-caption="Payment Proof">' + '<img src="' + data + '">' + '</a>';
                    } else
                    {
                        return '';
                    }
                }
            },            
            { "data": "notes" },
            { "data": "transaction_date" },
            { "data": "transaction_status"},
        ]
    });

    $('#edit_customer_profile').on('click', function() {
        var id = $(this).attr('data-id');

        var imageFile = $('#image')[0].files[0];

        var formData = new FormData();

        if (imageFile) {
            formData.append('image', imageFile);
        }

        formData.append('first_name', $('#first_name').val());
        formData.append('last_name', $('#last_name').val());
        formData.append('phone_number', $('#phone').val() + $('#number').val());
        formData.append('address', $('#address').val());
        formData.append('barangay', $('#barangay').val());
        formData.append('city', $('#city').val());
        formData.append('province', $('#province').val());
        formData.append('zip_code', $('#zip_code').val());
        formData.append('property_type', $('#property_type').val());
    
        $.ajax({
            url: '/api/customers/' + id,
            type: 'POST',
            headers: {
                "Authorization": "Bearer " + token
            },
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                alert(response.message);
                location.reload();
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });
});