$(document).ready(function (){
    const token = localStorage.getItem('access_token');

    document.getElementById('link_profile').setAttribute('href', '/technician-profile');

    $('#assigned_services').DataTable({
        dom: 'Blfrtip',
        buttons: [
            'excel',
            'csv',
            'pdf',
            'copy'
        ],
        ajax: 
        {
            url :"/api/assigned-services",
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
                render: function(data, type, row) {
                    return `<button class="btn btn-success edit-service-report" data-bs-toggle="modal" data-bs-target="#editServiceReportModal" data-id="${row.id}"><i class="mdi mdi-history"></i></button>`;
                }
            },
            { 
                "data": null,
                render: function(data, type, row) {
                    return `<button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#addFollowupServiceModal" data-id="${row.id}"><i class="mdi mdi-update"></i></button>`;
                }
            },
        ]
    });

    $(document).on('click', '.edit-service-report', function() {
        var id = $(this).data('id');
        $.ajax({
            url: '/api/services/' + id,
            type: 'GET',
            headers: {
                "Authorization": "Bearer " + token
            },
            success: function(services) {
                $('#service_id').val(services.id);
                $('#edit_service_report').attr('data-id', services.id);
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    $('#edit_service_report').on('click', function() {
        var id = $(this).attr('data-id');

        var serviceReportFile = $('#service_report')[0].files[0];

        var formData = new FormData();

        if (serviceReportFile) {
            formData.append('service_report', serviceReportFile);
        }

        formData.append('service_status', $('#service_status').val());
    
        $.ajax({
            url: '/api/services/' + id,
            type: 'POST',
            headers: {
                "Authorization": "Bearer " + token
            },
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                alert(response.message);
                $('#editServiceReportModal').modal('hide');
                $('#service_report_form').trigger('reset');
                $('#assigned_services').DataTable().ajax.reload();
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    $('#addFollowupServiceModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var service_id = button.data('id'); 
        var modal = $(this);
        modal.find('#service_id2').val(service_id);
    });

    $('#add_followup_service').on('click', function() {
        
        var feedback_data = {
            'service_id' : $('#service_id2').val(),
            'reason' : $('#reason').val(),
        }

        $.ajax({
            url: '/api/followup-services',
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                "Authorization": "Bearer " + token
            },
            data: feedback_data,
            success: function(response) {
                alert(response.message);
                $('#addFollowupServiceModal').modal('hide');
                $('#followup_service_form').trigger('reset');
                $('#assigned_services').DataTable().ajax.reload();
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    $('#finished_assigned_service').DataTable({
        dom: 'Blfrtip',
        buttons: [
            'excel',
            'csv',
            'pdf',
            'copy'
        ],
        ajax: 
        {
            url :"/api/finished-assigned-service",
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
            { "data": "service_date"},
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

    $('#completed_assigned_service').DataTable({
        dom: 'Blfrtip',
        buttons: [
            'excel',
            'csv',
            'pdf',
            'copy'
        ],
        ajax: 
        {
            url :"/api/completed-assigned-service",
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
            { "data": "service_date"},
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

    $('#follow_up_assigned_service').DataTable({
        dom: 'Blfrtip',
        buttons: [
            'excel',
            'csv',
            'pdf',
            'copy'
        ],
        ajax: 
        {
            url :"/api/follow-up-assigned-service",
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
                        return `<button class="btn btn-success edit-followup-service-report" data-bs-toggle="modal" data-bs-target="#editFollowupServiceReportModal" data-id="${row.id}"><i class="mdi mdi-history"></i></button>`;
                    }
                    else
                    {
                        return ``;
                    }
                }
            },
        ]
    });

    $(document).on('click', '.edit-followup-service-report', function() {
        var id = $(this).data('id');
        $.ajax({
            url: '/api/followup-services/' + id,
            type: 'GET',
            headers: {
                "Authorization": "Bearer " + token
            },
            success: function(followup_services) {
                $('#followup_id').val(followup_services.id);
                $('#edit_followup_service_report').attr('data-id', followup_services.id);
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    $('#edit_followup_service_report').on('click', function() {
        var id = $(this).attr('data-id');

        var followupServiceReportFile = $('#followup_report')[0].files[0];

        var formData = new FormData();

        if (followupServiceReportFile) {
            formData.append('followup_report', followupServiceReportFile);
        }

        formData.append('followup_status', $('#followup_status').val());
    
        $.ajax({
            url: '/api/followup-services/' + id,
            type: 'POST',
            headers: {
                "Authorization": "Bearer " + token
            },
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                alert(response.message);
                $('#editFollowupServiceReportModal').modal('hide');
                $('#followup_service_report_form').trigger('reset');
                $('#follow_up_assigned_service').DataTable().ajax.reload();
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    $('#finished_followup_assigned_service').DataTable({
        dom: 'Blfrtip',
        buttons: [
            'excel',
            'csv',
            'pdf',
            'copy'
        ],
        ajax: 
        {
            url :"/api/finished-followup-assigned-service",
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

    $('#completed_followup_assigned_service').DataTable({
        dom: 'Blfrtip',
        buttons: [
            'excel',
            'csv',
            'pdf',
            'copy'
        ],
        ajax: 
        {
            url :"/api/completed-followup-assigned-service",
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

    $('#technician_attendance').DataTable({
        dom: 'Blfrtip',
        buttons: [
            'excel',
            'csv',
            'pdf',
            'copy'
        ],
        ajax: 
        {
            url :"/api/technician-attendance",
            type: "GET",
            headers: {
                "Authorization": "Bearer " + token
            },
            dataSrc: "",
        },
        responsive: true,
        columns: [
            { "data": "attendance_date" },
            { "data": "time_in" },
            { "data": "time_out" },
            { "data": "total_time" },
            { "data": "attendance_status" },
            { "data": "remarks" },
            { 
                "data": null,
                render: function(data, type, row) {
                    if (row.time_out != null || new Date(row.attendance_date).toDateString() !== new Date().toDateString()) {
                        return '';
                    } 
                    else
                    {
                        return `<button class="btn btn-danger" id="logout_attendance" data-id="${row.id}"><i class="mdi mdi-clock-out"></i></button>`;
                    }
                }
            },
        ]
    });

    let attendance_date = null;
    let today = new Date();
    let today_formatted = today.toISOString().slice(0, 10);
    let dayOfWeek = today.getDay();

    if (dayOfWeek === 6 || dayOfWeek === 0)
    { 
        $('#login_button').prop('disabled', true);
    }
    else 
    { 
        $.ajax({
            url: '/api/technician-attendance',
            type: 'GET',
            headers: {
                'Authorization': 'Bearer ' + token
            },
            success: function(data) {
                if (data.length > 0) {
                    attendance_date = data[0].attendance_date;
                    if (attendance_date == today_formatted) {
                        $('#login_button').prop('disabled', true);
                    }
                }
            }
        });
    }

    $('#add_technician_attendance').on('click', function() { 
        var formData = new FormData();

        formData.append('remarks', $('#remarks').val());

        $.ajax({
            url: '/api/attendances',
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

    $(document).on('click', '#logout_attendance', function() {
        var id = $(this).data('id');

        if (confirm("Are you sure you want to logout?")) 
        {
            $.ajax({
                url: "/api/attendances/" + id,
                type: "PUT",
                headers: {
                    "Authorization": "Bearer " + token,
                },
                success: function(response) {
                    alert(response.message);
                    $('#technician_attendance').DataTable().ajax.reload();
                },
                error: function(xhr, status, error) {
                    alert(xhr.responseText);
                }
            });
        }
    });

    $('#borrow_inventory').DataTable({
        dom: 'Blfrtip',
        buttons: [
            'excel',
            'csv',
            'pdf',
            'copy'
        ],
        ajax: 
        {
            url :"/api/borrow-inventory",
            type: "GET",
            headers: {
                "Authorization": "Bearer " + token
            },
            dataSrc: "",
        },
        responsive: true,
        columns: [                   
            { "data": "id" },
            { "data": "name" },
            { "data": "stock" },
            { "data": "description" },
            {
                "data": null,
                render: function(data, type, row) {
                    if (row.isBorrowed)
                    {
                        return '';
                    } 
                    else 
                    {
                        return `<button class="btn btn-primary borrow-inventory" data-bs-toggle="modal" data-bs-target="#borrowInventoryModal" data-id="${row.id}"><i class="mdi mdi-cart"></i></button>`;
                    }
                }
            },    
        ]
    });

    $(document).on('click', '.borrow-inventory', function() {
        var id = $(this).data('id');
        $.ajax({
            url: '/api/inventories/' + id,
            type: 'GET',
            headers: {
                "Authorization": "Bearer " + token
            },
            success: function(inventories) {
                $('#inventory_id').val(inventories.id);
                $('#add_borrow_inventory').attr('data-id', inventories.id);
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    $('#add_borrow_inventory').on('click', function() {  
        var id = $(this).attr('data-id');

        var borrow_inventory_data = {
            'quantity' : $('#quantity').val(),
        }

        $.ajax({
            url: '/api/technician-inventories/' + id,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                "Authorization": "Bearer " + token
            },
            data: borrow_inventory_data,
            success: function(response) {
                alert(response.message);
                $('#borrowInventoryModal').modal('hide');
                $('#borrow_inventory_form').trigger('reset');
                $('#borrow_inventory').DataTable().ajax.reload();
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    $('#return_inventory').DataTable({
        dom: 'Blfrtip',
        buttons: [
            'excel',
            'csv',
            'pdf',
            'copy'
        ],
        ajax: 
        {
            url :"/api/return-inventory",
            type: "GET",
            headers: {
                "Authorization": "Bearer " + token
            },
            dataSrc: "",
        },
        responsive: true,
        columns: [
            { "data": "id" },
            { "data": "name" },
            { "data": "quantity" },
            { "data": "borrowed_date" },
            { "data": "returned_date" },
            { 
                "data": null,
                render: function(data, type, row) {
                    if (row.returned_date != null) 
                    {
                        return '';
                    } 
                    else
                    {
                        return `<button class="btn btn-success" id="add_return_inventory" data-id="${row.id}"><i class="mdi mdi-cart"></i></button>`;
                    }
                }
            },
        ]
    });

    $(document).on('click', '#add_return_inventory', function() {
        var inventory_id = $(this).data('id');

        if (confirm("Are you sure you want to return this inventory?")) {
            $.ajax({
                url: "/api/technician-inventories/" + inventory_id,
                type: "PUT",
                headers: {
                    "Authorization": "Bearer " + token,
                },
                success: function(response) {
                    alert(response.message);
                    $('#return_inventory').DataTable().ajax.reload();
                },
                error: function(xhr, status, error) {
                    alert(xhr.responseText);
                }
            });
        }
    });

    $('#edit_technician_profile').on('click', function() {
        var id = $(this).attr('data-id');

        var imageFile = $('#image')[0].files[0];

        var formData = new FormData();

        if (imageFile) {
            formData.append('image', imageFile);
        }
    
        $.ajax({
            url: '/api/technicians/' + id,
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