$(document).ready(function (){
    const token = localStorage.getItem('access_token');

    document.getElementById('link_profile').setAttribute('href', '/admin-profile');

    $("#followup_date").datepicker({
        minDate: 1,
        dateFormat: 'yy-mm-dd',
        beforeShowDay: function(date) {
            var day = date.getDay();
            return [!(day === 6 || day === 0) && date.getTime() >= new Date().getTime()];
        }
    });

    $('#followup_time_options').hide();

    $('#followup_date').on('change', function() {
        var selectedDate = $(this).val();
        if (selectedDate) 
        {
            $('#followup_time_options').show();
        } 
    });

    $('#all_services').DataTable({
        dom: 'Blfrtip',
        buttons: [
            'excel',
            'csv',
            'pdf',
            'copy'
        ],
        ajax: 
        {
            url :"/api/all-services",
            type: "GET",
            headers: {
                "Authorization": "Bearer " + token
            },
            dataSrc: "",
        },
        responsive: true,
        columns: [
            { "data": "id" },
            { "data": "customer_last_name" },
            { "data": "full_address" },
            { 
                "data": "full_contact",
                "render": function(data, type, full, meta) 
                {
                    return "<span class='not-text-capitalize'>" + data + "</span>";
                } 
            },
            { "data": "technician_last_names" },
            { "data": "admin_last_name" },
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
                "render": function(data, type, row) 
                {
                    if (row.service_status == 'checking')
                    {
                        return `<button class="btn btn-danger" id="cancel_service" data-bs-toggle="modal"   data-bs-target="#addCancelModal" data-id="${row.id}">
                                    <i class="mdi mdi-cancel"></i>
                                </button>`;
                    }
                    else 
                    {
                        return ``;
                    }
                }
            },
            { 
                "data": null,
                "render": function(data, type, row) 
                {
                    if (row.service_status == 'checking')
                    {
                        return `<button class="btn btn-primary" id="admin_check_service" data-id="${row.id}">
                                <i class="mdi mdi-eye"></i>
                            </button>`;
                    }
                    else 
                    {
                        return ``;
                    }
                }
            },
        ]
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
            'why' : $('#other_why').val(),
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
                $('#all_services').DataTable().ajax.reload();
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    $(document).on('click', '#admin_check_service', function() {
        var id = $(this).data('id');

        if (confirm("Are you sure you want to accept this booked service?")) 
        {
            $.ajax({
                url: "/api/services/" + id + "_method=PUT",
                type: "POST",
                headers: {
                    "Authorization": "Bearer " + token,
                },
                data: {
                    "service_status": "pending"
                },
                success: function(response) {
                    alert(response.message);
                    $('#all_services').DataTable().ajax.reload();
                },
                error: function(xhr, status, error) {
                    alert(xhr.responseText);
                }
            });
        }
    });

    $('#all_finished_service').DataTable({
        dom: 'Blfrtip',
        buttons: [
            'excel',
            'csv',
            'pdf',
            'copy'
        ],
        ajax: 
        {
            url :"/api/all-finished-service",
            type: "GET",
            headers: {
                "Authorization": "Bearer " + token
            },
            dataSrc: "",
        },
        responsive: true,
        columns: [
            { "data": "id" },
            { "data": "customer_last_name" },
            { "data": "full_address" },
            { 
                "data": "full_contact",
                "render": function(data, type, full, meta) 
                {
                    return "<span class='not-text-capitalize'>" + data + "</span>";
                } 
            },
            { "data": "technician_last_names" },
            { "data": "admin_last_name" },
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
                render: function(data, type, row) {
                    return `<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addServiceStatusModal" data-id="${row.id}"><i class="mdi mdi-eye"></i></button>`;
                }
            },
        ]
    });

    $('#addServiceStatusModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var service_id = button.data('id'); 
        var modal = $(this);
        modal.find('#service_id').val(service_id);
    });

    $('#add_service_status').on('click', function() {
        
        var service_status_data = {
            'service_status' : $('#service_status').val(),
        }

        var service_id = $('#service_id').val();

        $.ajax({
            url: '/api/services/' + service_id,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                "Authorization": "Bearer " + token
            },
            data: service_status_data,
            success: function(response) {
                alert(response.message);
                $('#addServiceStatusModal').modal('hide');
                $('#service_status_form').trigger('reset');
                $('#all_finished_service').DataTable().ajax.reload();
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    $('#all_completed_service').DataTable({
        dom: 'Blfrtip',
        buttons: [
            'excel',
            'csv',
            'pdf',
            'copy'
        ],
        ajax: 
        {
            url :"/api/all-completed-service",
            type: "GET",
            headers: {
                "Authorization": "Bearer " + token
            },
            dataSrc: "",
        },
        responsive: true,
        columns: [
            { "data": "id" },
            { "data": "customer_last_name" },
            { "data": "full_address" },
            { 
                "data": "full_contact",
                "render": function(data, type, full, meta) 
                {
                    return "<span class='not-text-capitalize'>" + data + "</span>";
                } 
            },
            { "data": "technician_last_names" },
            { "data": "admin_last_name" },
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

    $('#all_follow_up_service').DataTable({
        dom: 'Blfrtip',
        buttons: [
            'excel',
            'csv',
            'pdf',
            'copy'
        ],
        ajax: 
        {
            url :"/api/all-follow-up-service",
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
            { "data": "customer_last_name" },
            { "data": "full_address" },
            { 
                "data": "full_contact",
                "render": function(data, type, full, meta) 
                {
                    return "<span class='not-text-capitalize'>" + data + "</span>";
                } 
            },
            { "data": "reason" },
            { "data": "followup_date" },
            { "data": "followup_time" },
            { "data": "followup_status" },
            { 
                "data": null,
                render: function(data, type, row) {
                    if (row.followup_date != null && row.followup_time != null) 
                    {
                        return ``;
                    }
                    else
                    {
                        return `<button class="btn btn-primary edit-followup-schedule" data-bs-toggle="modal" data-bs-target="#editFollowupScheduleModal" data-id="${row.id}"><i class="mdi mdi-calendar-clock"></i></button>`;
                    }
                }
            },
        ]
    });

    $(document).on('click', '.edit-followup-schedule', function() {
        var id = $(this).data('id');
        $.ajax({
            url: '/api/followup-services/' + id,
            type: 'GET',
            headers: {
                "Authorization": "Bearer " + token
            },
            success: function(followup_services) {
                $('#edit_followup_schedule').attr('data-id', followup_services.id);
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    $('#edit_followup_schedule').on('click', function() {
        var id = $(this).attr('data-id');
        var followup_schedule_data = {
            'followup_date' : $('#followup_date').val(),
            'followup_time' : $('input[name=followup_time]:checked').val(),
        }
    
        $.ajax({
            url: '/api/followup-services/' + id,
            type: 'POST',
            headers: {
                "Authorization": "Bearer " + token
            },
            data: followup_schedule_data,
            success: function(response) {
                alert(response.message);
                $('#editFollowupScheduleModal').modal('hide');
                $('#followup_schedule_form').trigger('reset');
                $('#all_follow_up_service').DataTable().ajax.reload();
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    $('#all_finished_followup_service').DataTable({
        dom: 'Blfrtip',
        buttons: [
            'excel',
            'csv',
            'pdf',
            'copy'
        ],
        ajax: 
        {
            url :"/api/all-finished-followup-service",
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
            { "data": "customer_last_name" },
            { "data": "full_address" },
            { 
                "data": "full_contact",
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
                    return `<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addFollowupStatusModal" data-id="${row.id}"><i class="mdi mdi-eye"></i></button>`;
                }
            },
        ]
    });

    $('#addFollowupStatusModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var followup_id = button.data('id'); 
        var modal = $(this);
        modal.find('#followup_id').val(followup_id);
    });

    $('#add_followup_status').on('click', function() {
        
        var followup_status_data = {
            'followup_status' : $('#followup_status').val(),
        }

        var followup_id = $('#followup_id').val();

        $.ajax({
            url: '/api/followup-services/' + followup_id,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                "Authorization": "Bearer " + token
            },
            data: followup_status_data,
            success: function(response) {
                alert(response.message);
                $('#addFollowupStatusModal').modal('hide');
                $('#followup_status_form').trigger('reset');
                $('#all_finished_followup_service').DataTable().ajax.reload();
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    $('#all_completed_followup_service').DataTable({
        dom: 'Blfrtip',
        buttons: [
            'excel',
            'csv',
            'pdf',
            'copy'
        ],
        ajax: 
        {
            url :"/api/all-completed-followup-service",
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
            { "data": "customer_last_name" },
            { "data": "full_address" },
            { 
                "data": "full_contact",
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

    $('#all_cancelled_service').DataTable({
        dom: 'Blfrtip',
        buttons: [
            'excel',
            'csv',
            'pdf',
            'copy'
        ],
        ajax: 
        {
            url :"/api/all-cancelled-service",
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
            { "data": "customer_last_name" },
            { "data": "full_address" },
            { 
                "data": "full_contact",
                "render": function(data, type, full, meta) 
                {
                    return "<span class='not-text-capitalize'>" + data + "</span>";
                } 
            },
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

    $('#all_service_warranty').DataTable({
        dom: 'Blfrtip',
        buttons: [
            'excel',
            'csv',
            'pdf',
            'copy'
        ],
        ajax: 
        {
            url :"/api/all-service-warranty",
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
                    if (row.warranty_status != 'active') 
                    {
                        return '';
                    } 
                    else 
                    {
                        return `<button class="btn btn-primary edit-warranty-status" data-bs-toggle="modal" data-bs-target="#editWarrantyStatusModal" data-id="${row.id}"><i class="mdi mdi-eye"></i></button>`;
                    }
                }
            },
        ]
    });

    $(document).on('click', '.edit-warranty-status', function() {
        var id = $(this).data('id');
        $.ajax({
            url: '/api/warranties/' + id,
            type: 'GET',
            headers: {
                "Authorization": "Bearer " + token
            },
            success: function(warranties) {
                $('#service_id').val(warranties.service_id);
                $('#edit_warranty_status').attr('data-id', warranties.id);
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    $('#edit_warranty_status').on('click', function() {
        var id = $(this).attr('data-id');
        var warranty_status_data = {
            'warranty_status' : $('#warranty_status').val(),
        }
    
        $.ajax({
            url: '/api/warranties/' + id,
            type: 'PUT',
            headers: {
                "Authorization": "Bearer " + token
            },
            data: warranty_status_data,
            success: function(response) {
                alert(response.message);
                $('#editWarrantyStatusModal').modal('hide');
                $('#all_service_warranty').DataTable().ajax.reload();
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    $('#all_warranty_claim').DataTable({
        dom: 'Blfrtip',
        buttons: [
            'excel',
            'csv',
            'pdf',
            'copy'
        ],
        ajax: 
        {
            url :"/api/all-warranty-claim",
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
            { 
                "data": null,
                render: function(data, type, row) {
                    if (row.claim_status == 'pending') 
                    {
                        return `<button class="btn btn-primary edit-warranty-claim-status" data-bs-toggle="modal" data-bs-target="#editWarrantyClaimStatusModal" data-id="${row.id}"><i class="mdi mdi-eye"></i></button>`;
                    } 
                    else 
                    {
                        return '';
                    }
                }
            },
        ]
    });

    $(document).on('click', '.edit-warranty-claim-status', function() {
        var id = $(this).data('id');
        $.ajax({
            url: '/api/warranty-claims/' + id,
            type: 'GET',
            headers: {
                "Authorization": "Bearer " + token
            },
            success: function(warranty_claims) {
                $('#warranty_id').val(warranty_claims.warranty_id);
                $('#edit_warranty_claim_status').attr('data-id', warranty_claims.id);
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    $('#edit_warranty_claim_status').on('click', function() {
        var id = $(this).attr('data-id');
        var warranty_claim_status_data = {
            'claim_status' : $('#claim_status').val(),
        }
    
        $.ajax({
            url: '/api/warranty-claims/' + id,
            type: 'PUT',
            headers: {
                "Authorization": "Bearer " + token
            },
            data: warranty_claim_status_data,
            success: function(response) {
                alert(response.message);
                $('#editWarrantyClaimStatusModal').modal('hide');
                $('#warranty_claim_status_form').trigger('reset');
                $('#all_warranty_claim').DataTable().ajax.reload();
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    $('#all_transaction').DataTable({
        dom: 'Blfrtip',
        buttons: [
            'excel',
            'csv',
            'pdf',
            'copy'
        ],
        ajax: 
        {
            url :"/api/all-transaction",
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
            { "data": "customer_full_name" },
            { "data": "full_address" },
            { 
                "data": "full_contact",
                "render": function(data, type, full, meta) 
                {
                    return "<span class='not-text-capitalize'>" + data + "</span>";
                } 
            },
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
                "data": null,
                render: function(data, type, row) {
                    if (row.transaction_status == 'processing' || row.transaction_status == 'pending') 
                    {
                        return `<button class="btn btn-primary edit-transaction-status" data-bs-toggle="modal" data-bs-target="#editTransactionStatusModal" data-id="${row.id}"><i class="mdi mdi-eye"></i></button>`;
                    }
                    else
                    {
                        return ``;
                    }
                }
            },
        ]
    });

    $(document).on('click', '.edit-transaction-status', function() {
        var id = $(this).data('id');
        $.ajax({
            url: '/api/transactions/' + id,
            type: 'GET',
            headers: {
                "Authorization": "Bearer " + token
            },
            success: function(transactions) {
                $('#transaction_id').val(transactions.id);
                $('#transaction_history_payment_method').val(transactions.payment_method);
                $('#transaction_status').val(transactions.transaction_status);
                $('#edit_transaction_status').attr('data-id', transactions.id);
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    $('#edit_transaction_status').on('click', function() {
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
        formData.append('transaction_status', $('#transaction_status').val());
    
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
                $('#editTransactionStatusModal').modal('hide');
                $('#transaction_status_form').trigger('reset');
                $('#all_transaction').DataTable().ajax.reload();
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    $('#all_cancelled_transaction').DataTable({
        dom: 'Blfrtip',
        buttons: [
            'excel',
            'csv',
            'pdf',
            'copy'
        ],
        ajax: 
        {
            url :"/api/all-cancelled-transaction",
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
            { "data": "customer_full_name" },
            { "data": "full_address" },
            { 
                "data": "full_contact",
                "render": function(data, type, full, meta) 
                {
                    return "<span class='not-text-capitalize'>" + data + "</span>";
                } 
            },
            { "data": "service_price" },
            { "data": "voucher_id" },
            { "data": "discount" },
            { "data": "payment_method" },
            { "data": "amount" },
            {
                data: 'payment_proof',
                render: function (data, type, full, meta) 
                {
                    if (data) 
                    {
                        return '<img src="' + data + '"/>';
                    } 
                    else 
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

    $('#all_attendance').DataTable({
        dom: 'Blfrtip',
        buttons: [
            'excel',
            'csv',
            'pdf',
            'copy'
        ],
        ajax: 
        {
            url :"/api/all-attendance",
            type: "GET",
            headers: {
                "Authorization": "Bearer " + token
            },
            dataSrc: "",
        },
        responsive: true,
        columns: [
            { "data": "id" },
            { "data": "technician_id" },
            { "data": "full_name" },
            { "data": "attendance_date" },
            { "data": "time_in" },
            { "data": "time_out" },
            { "data": "total_time" },
            { "data": "attendance_status" },
            { "data": "remarks" },
            { 
                "data": null,
                render: function(data, type, row) {
                    if (new Date(row.attendance_date).toDateString() !== new Date().toDateString()) 
                    {
                        return '';
                    } 
                    else 
                    {
                        return `<button class="btn btn-primary edit-attendance-status" data-bs-toggle="modal" data-bs-target="#editAttendanceStatusModal" data-id="${row.id}"><i class="mdi mdi-eye"></i></button>`;
                    }
                }
            },
        ]
    });

    $(document).on('click', '.edit-attendance-status', function() {
        var id = $(this).data('id');
        $.ajax({
            url: '/api/attendances/' + id,
            type: 'GET',
            headers: {
                "Authorization": "Bearer " + token
            },
            success: function(attendances) {
                $('#attendance_id').val(attendances.id);
                $('#remarks').val(attendances.remarks);
                $('#attendance_status').val(attendances.attendance_status);
                
                $('#edit_attendance_status').attr('data-id', attendances.id);
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    $('#edit_attendance_status').on('click', function() {
        var id = $(this).attr('data-id');
        var attendance_status_data = {
            'remarks' : $('#remarks').val(),
            'attendance_status' : $('#attendance_status').val(),
        }
    
        $.ajax({
            url: '/api/attendances/' + id,
            type: 'PUT',
            headers: {
                "Authorization": "Bearer " + token
            },
            data: attendance_status_data,
            success: function(response) {
                alert(response.message);
                $('#editAttendanceStatusModal').modal('hide');
                $('#attendance_status_form').trigger('reset');
                $('#all_attendance').DataTable().ajax.reload();
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    $('#edit_admin_profile').on('click', function() {
        var id = $(this).attr('data-id');

        var imageFile = $('#image')[0].files[0];

        var formData = new FormData();

        if (imageFile) {
            formData.append('image', imageFile);
        }
    
        $.ajax({
            url: '/api/admins/' + id,
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