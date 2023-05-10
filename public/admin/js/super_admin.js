$(document).ready(function (){
    const token = localStorage.getItem('access_token');

    document.getElementById('link_profile').setAttribute('href', '/super-admin-profile');

    $('#walkin_service').DataTable({
        dom: 'Blfrtip',
        buttons: [
            'excel',
            'csv',
            'pdf',
            'copy'
        ],
        ajax: 
        {
            url :"/api/walkin-service",
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

    $('#all_feedback').DataTable({
        dom: 'Blfrtip',
        buttons: [
            'excel',
            'csv',
            'pdf',
            'copy'
        ],
        ajax: 
        {
            url :"/api/all-feedback",
            type: "GET",
            headers: {
                "Authorization": "Bearer " + token
            },
            dataSrc: "",
        },
        responsive: true,
        columns: [
            { "data": "service_id" },
            { "data": "customer_full_name" },
            { "data": "technician_last_names" },
            { "data": "admin_last_name" },
            { "data": "rating" },
            { "data": "review" },
            { 
                "data": null,
                render: function(data, type, row) {
                    return `<button class="btn btn-danger" id="delete_feedback" data-id="${row.id}"><i class="mdi mdi-delete"></i></button>`;
                }
            },
        ]
    });

    $(document).on('click', '#delete_feedback', function() {
        var feedback_id = $(this).data('id');

        if (confirm("Are you sure you want to delete this service feedback?")) {
            $.ajax({
                url: "/api/feedbacks/" + feedback_id,
                type: "DELETE",
                headers: {
                    "Authorization": "Bearer " + token,
                },
                success: function(response) {
                    alert(response.message);
                    $('#all_feedback').DataTable().ajax.reload();
                },
                error: function(xhr, status, error) {
                    alert(xhr.responseText);
                }
            });
        }
    });

    $('#all_post_consultation').DataTable({
        dom: 'Blfrtip',
        buttons: [
            'excel',
            'csv',
            'pdf',
            'copy'
        ],
        ajax: 
        {
            url :"/api/all-post-consultation",
            type: "GET",
            headers: {
                "Authorization": "Bearer " + token
            },
            dataSrc: "",
        },
        responsive: true,
        columns: [
            { "data": "service_id" },
            { "data": "customer_full_name" },
            { "data": "technician_last_names" },
            { "data": "admin_last_name" },
            { "data": "message" },
            { "data": "recommendation" },
            { "data": "consultation_date" },
            { "data": "consultation_status" },
            { 
                "data": null,
                render: function(data, type, row) {
                    if (row.recommendation != null) 
                    {
                        return '';
                    }
                    else
                    {
                        return `<button class="btn btn-success edit-post-consultation" data-bs-toggle="modal" data-bs-target="#addRecommendationModal" data-id="${row.id}"><i class="mdi mdi-reply"></i></button>`;
                    }
                }
            },
        ]
    });

    $('#addRecommendationModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var post_consultation_id = button.data('id'); 
        var modal = $(this);
        modal.find('#post_consultation_id').val(post_consultation_id);
    });

    $('#add_recommendation').on('click', function() {
        
        var recommendation_data = {
            'recommendation' : $('#recommendation').val(),
            'consultation_status' : 'read',
        }

        var post_consultation_id = $('#post_consultation_id').val();

        $.ajax({
            url: '/api/post-consultations/' + post_consultation_id,
            type: 'PUT',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                "Authorization": "Bearer " + token
            },
            data: recommendation_data,
            success: function(response) {
                alert(response.message);
                $('#addRecommendationModal').modal('hide');
                $('#recommendation_form').trigger('reset');
                $('#all_post_consultation').DataTable().ajax.reload();
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    $('#all_voucher').DataTable({
        dom: 'Blfrtip',
        buttons: [
            'excel',
            'csv',
            'pdf',
            'copy'
        ],
        ajax: 
        {
            url :"/api/all-voucher",
            type: "GET",
            headers: {
                "Authorization": "Bearer " + token
            },
            dataSrc: "",
        },
        responsive: true,
        columns: [
            { "data": "id" },
            { "data": "discount" },
            { "data": "description" },
            { "data": "start_date" },
            { "data": "end_date" },
            { "data": "usage_count" },
            { "data": "voucher_status" },
            { 
                "data": null,
                render: function(data, type, row) {
                    return `<button class="btn btn-primary edit-voucher" data-bs-toggle="modal" data-bs-target="#editVoucherModal" data-id="${row.id}"><i class="mdi mdi-pencil"></i></button>`;
                }
            },
            { 
                "data": null,
                render: function(data, type, row) {
                    return `<button class="btn btn-danger" id="delete_voucher" data-id="${row.id}"><i class="mdi mdi-delete"></i></button>`;
                }
            },
        ]
    });

    $('#add_voucher').on('click', function() {
        
        var voucher_data = {
            'discount' : $('#discount').val(),
            'description' : $('#description').val(),
            'start_date' : $('#start_date').val(),
            'end_date' : $('#end_date').val(),
            'usage_count' : $('#usage_count').val(),
        }

        $.ajax({
            url: '/api/vouchers',
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                "Authorization": "Bearer " + token
            },
            data: voucher_data,
            success: function(response) {
                alert(response.message);
                $('#addVoucherModal').modal('hide');
                $('#add_voucher_form').trigger('reset');
                $('#all_voucher').DataTable().ajax.reload();
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    $(document).on('click', '.edit-voucher', function() {
        var id = $(this).data('id');
        $.ajax({
            url: '/api/vouchers/' + id,
            type: 'GET',
            headers: {
                "Authorization": "Bearer " + token
            },
            success: function(voucher) {
                $('#voucher_id').val(voucher.id);
                $('#discount2').val(voucher.discount);
                $('#description2').val(voucher.description);
                $('#start_date2').val(voucher.start_date);
                $('#end_date2').val(voucher.end_date);
                $('#usage_count2').val(voucher.usage_count);
                $('#edit_voucher').attr('data-id', voucher.id);
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    $('#edit_voucher').on('click', function() {
        var id = $(this).attr('data-id');
        var voucher_data = {
            'discount' : $('#discount2').val(),
            'description' : $('#description2').val(),
            'start_date' : $('#start_date2').val(),
            'end_date' : $('#end_date2').val(),
            'usage_count' : $('#usage_count2').val(),
        }
    
        $.ajax({
            url: '/api/vouchers/' + id,
            type: 'PUT',
            headers: {
                "Authorization": "Bearer " + token
            },
            data: voucher_data,
            success: function(response) {
                alert(response.message);
                $('#editVoucherModal').modal('hide');
                $('#edit_voucher_form').trigger('reset');
                $('#all_voucher').DataTable().ajax.reload();
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    $(document).on('click', '#delete_voucher', function() {
        var voucher_id = $(this).data('id');

        if (confirm("Are you sure you want to delete this voucher?")) {
            $.ajax({
                url: "/api/vouchers/" + voucher_id,
                type: "DELETE",
                headers: {
                    "Authorization": "Bearer " + token,
                },
                success: function(response) {
                    alert(response.message);
                    $('#all_voucher').DataTable().ajax.reload();
                },
                error: function(xhr, status, error) {
                    alert(xhr.responseText);
                }
            });
        }
    });

    $('#attendance_logs').DataTable({
        dom: 'Blfrtip',
        buttons: [
            'excel',
            'csv',
            'pdf',
            'copy'
        ],
        ajax: 
        {
            url :"/api/attendance-logs",
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
            { 
                data: 'photo_in',
                render: function (data, type, row) 
                {
                    if (data) 
                    {
                        return '<a href="' + data + '" data-fancybox="photo-in" data-caption="Login Photo">' + '<img src="' + data + '">' + '</a>';
                    } else
                    {
                        return '';
                    }
                }
            },
            { "data": "time_out" },
            { 
                data: 'photo_out',
                render: function (data, type, row) 
                {
                    if (data) 
                    {
                        return '<a href="' + data + '" data-fancybox="photo-out" data-caption="Logout Photo">' + '<img src="' + data + '">' + '</a>';
                    } else
                    {
                        return '';
                    }
                }
            },
            { "data": "total_time" },
            { "data": "attendance_status" },
            { "data": "remarks" },
        ]
    });

    $('#all_inventory').DataTable({
        dom: 'Blfrtip',
        buttons: [
            'excel',
            'csv',
            'pdf',
            'copy'
        ],
        ajax: 
        {
            url :"/api/all-inventory",
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
                    return `<button class="btn btn-primary edit-inventory" data-bs-toggle="modal" data-bs-target="#editInventoryModal" data-id="${row.id}"><i class="mdi mdi-pencil"></i></button>`;
                }
            },
            { 
                "data": null,
                render: function(data, type, row) {
                    return `<button class="btn btn-danger" id="delete_inventory" data-id="${row.id}"><i class="mdi mdi-delete"></i></button>`;
                }
            },
        ]
    });

    $('#add_inventory').on('click', function() {
        
        var inventory_data = {
            'name' : $('#name').val(),
            'description' : $('#description').val(),
            'stock' : $('#stock').val(),
        }

        $.ajax({
            url: '/api/inventories',
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                "Authorization": "Bearer " + token
            },
            data: inventory_data,
            success: function(response) {
                alert(response.message);
                $('#addInventoryModal').modal('hide');
                $('#add_inventory_form').trigger('reset');
                $('#all_inventory').DataTable().ajax.reload();
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    $(document).on('click', '.edit-inventory', function() {
        var id = $(this).data('id');
        $.ajax({
            url: '/api/inventories/' + id,
            type: 'GET',
            headers: {
                "Authorization": "Bearer " + token
            },
            success: function(inventory) {
                $('#inventory_id').val(inventory.id);
                $('#name2').val(inventory.name);
                $('#description2').val(inventory.description);
                $('#stock2').val(inventory.stock);
                $('#edit_inventory').attr('data-id', inventory.id);
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    $('#edit_inventory').on('click', function() {
        var id = $(this).attr('data-id');
        var inventory_data = {
            'name' : $('#name2').val(),
            'description' : $('#description2').val(),
            'stock' : $('#stock2').val(),
        }
    
        $.ajax({
            url: '/api/inventories/' + id,
            type: 'PUT',
            headers: {
                "Authorization": "Bearer " + token
            },
            data: inventory_data,
            success: function(response) {
                alert(response.message);
                $('#editInventoryModal').modal('hide');
                $('#edit_inventory_form').trigger('reset');
                $('#all_inventory').DataTable().ajax.reload();
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    $(document).on('click', '#delete_inventory', function() {
        var inventory_id = $(this).data('id');

        if (confirm("Are you sure you want to delete this inventory?")) {
            $.ajax({
                url: "/api/inventories/" + inventory_id,
                type: "DELETE",
                headers: {
                    "Authorization": "Bearer " + token,
                },
                success: function(response) {
                    alert(response.message);
                    $('#all_inventory').DataTable().ajax.reload();
                },
                error: function(xhr, status, error) {
                    alert(xhr.responseText);
                }
            });
        }
    });

    $('#inventory_logs').DataTable({
        dom: 'Blfrtip',
        buttons: [
            'excel',
            'csv',
            'pdf',
            'copy'
        ],
        ajax: 
        {
            url :"/api/inventory-logs",
            type: "GET",
            headers: {
                "Authorization": "Bearer " + token
            },
            dataSrc: "",
        },
        responsive: true,
        columns: [
            { "data": "log_id" },
            { "data": "technician_id" },
            { "data": "full_name" },
            { "data": "id" },
            { "data": "name" },
            { "data": "quantity" },
            { "data": "borrowed_date" },
            { "data": "returned_date" },
        ]
    });

    $('#all_super_admin').DataTable({
        dom: 'Blfrtip',
        buttons: [
            'excel',
            'csv',
            'pdf',
            'copy'
        ],
        ajax: 
        {
            url :"/api/all-super-admin",
            type: "GET",
            headers: {
                "Authorization": "Bearer " + token
            },
            dataSrc: "",
        },
        responsive: true,
        columns: [
            { "data": "id" },
            { "data": "user_id" },
            { "data": "first_name" },
            { "data": "last_name" },
            {
                "data": "email",
                "render": function(data, type, full, meta) 
                {
                    return "<span class='not-text-capitalize'>" + data + "</span>";
                }
            },
            { "data": "phone_number" },
            { "data": "team_position" },
            { 
                "data": null,
                render: function(data, type, row) 
                {
                    return `<button class="btn btn-primary edit-super-admin" data-bs-toggle="modal" data-bs-target="#editSuperAdminModal" data-id="${row.id}"><i class="mdi mdi-pencil"></i></button>`;
                }
            },
        ]
    });

    $('#add_super_admin').on('click', function() {
        
        var form_data = $("#add_super_admin_form").serialize();

        $.ajax({
            url: "/api/super-admins",
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                "Authorization": "Bearer " + token
            },
            data: form_data,
            success: function(response) {
                alert(response.message);
                $('#addSuperAdminModal').modal('hide');
                $('#add_super_admin_form').trigger('reset');
                $('#all_super_admin').DataTable().ajax.reload();
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    $(document).on('click', '.edit-super-admin', function() {
        var id = $(this).data('id');
        $.ajax({
            url: '/api/super-admins/' + id,
            type: 'GET',
            headers: {
                "Authorization": "Bearer " + token
            },
            success: function(super_admin) {
                $('#super_admin_id').val(super_admin.id);
                $('#first_name2').val(super_admin.first_name);
                $('#last_name2').val(super_admin.last_name);
                $('#team_position2').val(super_admin.team_position);
                $('#edit_super_admin').attr('data-id', super_admin.id);
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    $('#edit_super_admin').on('click', function() {
        var id = $(this).attr('data-id');
        var admin_data = {
            'first_name' : $('#first_name2').val(),
            'last_name' : $('#last_name2').val(),
            'team_position' : $('#team_position2').val(),
        }
    
        $.ajax({
            url: '/api/super-admins/' + id,
            type: 'POST',
            headers: {
                "Authorization": "Bearer " + token
            },
            data: admin_data,
            success: function(response) {
                alert(response.message);
                $('#editSuperAdminModal').modal('hide');
                $('#edit_super_admin_form').trigger('reset');
                $('#all_super_admin').DataTable().ajax.reload();
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    $('#all_admin').DataTable({
        dom: 'Blfrtip',
        buttons: [
            'excel',
            'csv',
            'pdf',
            'copy'
        ],
        ajax: 
        {
            url :"/api/all-admin",
            type: "GET",
            headers: {
                "Authorization": "Bearer " + token
            },
            dataSrc: "",
        },
        responsive: true,
        columns: [
            { "data": "id" },
            { "data": "user_id" },
            { "data": "first_name" },
            { "data": "last_name" },
            {
                "data": "email",
                "render": function(data, type, full, meta) 
                {
                    return "<span class='not-text-capitalize'>" + data + "</span>";
                }
            },
            { "data": "phone_number" },
            { "data": "team_position" },
            { 
                "data": null,
                render: function(data, type, row) 
                {
                    return `<button class="btn btn-primary edit-admin" data-bs-toggle="modal" data-bs-target="#editAdminModal" data-id="${row.id}"><i class="mdi mdi-pencil"></i></button>`;
                }
            },
        ]
    });

    $('#add_admin').on('click', function() {
        
        var admin_data = {
            'first_name': $('#first_name').val(),
            'last_name': $('#last_name').val(),
            'email': $('#email').val(),
            'password': $('#password').val(),
            'password_confirmation': $('#password-confirm').val(),
            'phone_number': $('#phone').val() + $('#number').val(),
            'team_position': $('#team_position').val()
        }

        $.ajax({
            url: "/api/admins",
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                "Authorization": "Bearer " + token
            },
            data: admin_data,
            success: function(response) {
                alert(response.message);
                $('#addAdminModal').modal('hide');
                $('#add_admin_form').trigger('reset');
                $('#all_admin').DataTable().ajax.reload();
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    $(document).on('click', '.edit-admin', function() {
        var id = $(this).data('id');
        $.ajax({
            url: '/api/admins/' + id,
            type: 'GET',
            headers: {
                "Authorization": "Bearer " + token
            },
            success: function(admin) {
                $('#admin_id').val(admin.id);
                $('#first_name2').val(admin.first_name);
                $('#last_name2').val(admin.last_name);
                $('#team_position2').val(admin.team_position);
                $('#edit_admin').attr('data-id', admin.id);
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    $('#edit_admin').on('click', function() {
        var id = $(this).attr('data-id');
        var admin_data = {
            'first_name' : $('#first_name2').val(),
            'last_name' : $('#last_name2').val(),
            'team_position' : $('#team_position2').val(),
        }
    
        $.ajax({
            url: '/api/admins/' + id,
            type: 'POST',
            headers: {
                "Authorization": "Bearer " + token
            },
            data: admin_data,
            success: function(response) {
                alert(response.message);
                $('#editAdminModal').modal('hide');
                $('#edit_admin_form').trigger('reset');
                $('#all_admin').DataTable().ajax.reload();
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    $('#all_technician').DataTable({
        dom: 'Blfrtip',
        buttons: [
            'excel',
            'csv',
            'pdf',
            'copy'
        ],
        ajax: 
        {
            url :"/api/all-technician",
            type: "GET",
            headers: {
                "Authorization": "Bearer " + token
            },
            dataSrc: "",
        },
        responsive: true,
        columns: [
            { "data": "id" },
            { "data": "user_id" },
            { "data": "first_name" },
            { "data": "last_name" },
            {
                "data": "email",
                "render": function(data, type, full, meta) 
                {
                    return "<span class='not-text-capitalize'>" + data + "</span>";
                }
            },
            { "data": "phone_number" },
            { "data": "age" },
            { "data": "experience" },
            { "data": "specialties" },
            { 
                "data": null,
                render: function(data, type, row) 
                {
                    return `<button class="btn btn-primary edit-technician" data-bs-toggle="modal" data-bs-target="#editTechnicianModal" data-id="${row.id}"><i class="mdi mdi-pencil"></i></button>`;
                }
            },
        ]
    });

    $('#add_technician').on('click', function() {
        
        var technician_data = {
            'first_name' : $('#first_name').val(),
            'last_name' : $('#last_name').val(),
            'email' : $('#email').val(),
            'password' : $('#password').val(),
            'password_confirmation' : $('#password_confirmation').val(),
            'password_confirmation' : $('#password-confirm').val(),
            'phone_number' : $('#phone').val() + $('#number').val(),
            'age' : $('#age').val(),
            'experience' : $('#experience').val(),
            'specialties' : $('#specialties').val(),
        }

        $.ajax({
            url: "/api/technicians",
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                "Authorization": "Bearer " + token
            },
            data: technician_data,
            success: function(response) {
                alert(response.message);
                $('#addTechnicianModal').modal('hide');
                $('#add_technician_form').trigger('reset');
                $('#all_technician').DataTable().ajax.reload();
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    $(document).on('click', '.edit-technician', function() {
        var id = $(this).data('id');
        $.ajax({
            url: '/api/technicians/' + id,
            type: 'GET',
            headers: {
                "Authorization": "Bearer " + token
            },
            success: function(technician) {
                $('#technician_id').val(technician.id);
                $('#first_name2').val(technician.first_name);
                $('#last_name2').val(technician.last_name);
                $('#age2').val(technician.age);
                $('#experience2').val(technician.experience);
                $('#specialties2').val(technician.specialties);
                $('#edit_technician').attr('data-id', technician.id);
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    $('#edit_technician').on('click', function() {
        var id = $(this).attr('data-id');
        var technician_data = {
            'first_name' : $('#first_name2').val(),
            'last_name' : $('#last_name2').val(),
            'age' : $('#age2').val(),
            'experience' : $('#experience2').val(),
            'specialties' : $('#specialties2').val(),
        }
    
        $.ajax({
            url: '/api/technicians/' + id,
            type: 'POST',
            headers: {
                "Authorization": "Bearer " + token
            },
            data: technician_data,
            success: function(response) {
                alert(response.message);
                $('#editTechnicianModal').modal('hide');
                $('#edit_technician_form').trigger('reset');
                $('#all_technician').DataTable().ajax.reload();
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    $('#all_customer').DataTable({
        dom: 'Blfrtip',
        buttons: [
            'excel',
            'csv',
            'pdf',
            'copy'
        ],
        ajax: 
        {
            url :"/api/all-customer",
            type: "GET",
            headers: {
                "Authorization": "Bearer " + token
            },
            dataSrc: "",
        },
        responsive: true,
        columns: [
            { "data": "id" },
            { "data": "user_id" },
            { "data": "first_name" },
            { "data": "last_name" },
            {
                "data": "email",
                "render": function(data, type, full, meta) {
                    if (data) {
                        return "<span class='not-text-capitalize'>" + data + "</span>";
                    } else {
                        return '';
                    }
                }
            },            
            { "data": "phone_number" },
            { "data": "property_type" },
            { "data": "address" },
            { "data": "barangay" },
            { "data": "city" },
            { "data": "province" },
            { "data": "zip_code" },
            { 
                "data": null,
                render: function(data, type, row) 
                {
                    return `<button class="btn btn-primary edit-customer" data-bs-toggle="modal" data-bs-target="#editCustomerModal" data-id="${row.id}"><i class="mdi mdi-pencil"></i></button>`;
                }
            },
            { 
                "data": null,
                render: function(data, type, row) {
                    return `<button class="btn btn-danger" id="delete_customer" data-id="${row.id}"><i class="mdi mdi-delete"></i></button>`;
                }
            },
        ]
    });

    $('#add_customer').on('click', function() {
        
        var customer_data = {
            "first_name": $('#first_name').val(),
            "last_name": $('#last_name').val(),
            "address": $('#address').val(),
            "barangay": $('#barangay').val(),
            "city": $('#city').val(),
            "province": $('#province').val(),
            "zip_code": $('#zip_code').val(),
            "property_type": $('#property_type').val()
        };

        $.ajax({
            url: "/api/customers",
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                "Authorization": "Bearer " + token
            },
            data: customer_data,
            success: function(response) {
                alert(response.message);
                $('#addCustomerModal').modal('hide');
                $('#add_customer_form').trigger('reset');
                $('#all_customer').DataTable().ajax.reload();
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    $(document).on('click', '.edit-customer', function() {
        var id = $(this).data('id');
        $.ajax({
            url: '/api/customers/' + id,
            type: 'GET',
            headers: {
                "Authorization": "Bearer " + token
            },
            success: function(customer) {
                $('#customer_id').val(customer.id);
                $('#edit_first_name').val(customer.first_name);
                $('#edit_last_name').val(customer.last_name);
                $('#edit_address').val(customer.address);
                $('#edit_barangay').val(customer.barangay);
                $('#edit_city').val(customer.city);
                $('#edit_province').val(customer.province);
                $('#edit_zip_code').val(customer.zip_code);
                $('#edit_property_type').val(customer.property_type);
                $('#edit_customer').attr('data-id', customer.id);
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    $('#edit_customer').on('click', function() {
        var id = $(this).attr('data-id');
        var customer_data = {
            'first_name' : $('#edit_first_name').val(),
            'last_name' : $('#edit_last_name').val(),
            'address' : $('#edit_address').val(),
            'barangay' : $('#edit_barangay').val(),
            'city' : $('#edit_city').val(),
            'province' : $('#edit_province').val(),
            'zip_code' : $('#edit_zip_code').val(),
            'property_type' : $('#edit_property_type').val(),
        }
    
        $.ajax({
            url: '/api/customers/' + id,
            type: 'POST',
            headers: {
                "Authorization": "Bearer " + token
            },
            data: customer_data,
            success: function(response) {
                alert(response.message);
                $('#editCustomerModal').modal('hide');
                $('#edit_customer_form').trigger('reset');
                $('#all_customer').DataTable().ajax.reload();
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    $(document).on('click', '#delete_customer', function() {
        var customer_id = $(this).data('id');

        if (confirm("Are you sure you want to delete this customer?")) {
            $.ajax({
                url: "/api/customers/" + customer_id,
                type: "DELETE",
                headers: {
                    "Authorization": "Bearer " + token,
                },
                success: function(response) {
                    alert(response.message);
                    $('#all_customer').DataTable().ajax.reload();
                },
                error: function(xhr, status, error) {
                    alert(xhr.responseText);
                }
            });
        }
    });

    $('#all_user').DataTable({
        dom: 'Blfrtip',
        buttons: [
            'excel',
            'csv',
            'pdf',
            'copy'
        ],
        ajax: 
        {
            url :"/api/all-user",
            type: "GET",
            headers: {
                "Authorization": "Bearer " + token
            },
            dataSrc: "",
        },
        responsive: true,
        columns: [
            { "data": "id" },
            { "data": "role" },
            { "data": "role_id" },
            {"data": "full_name" },
            {
                "data": "email",
                "render": function(data, type, full, meta) 
                {
                    return "<span class='not-text-capitalize'>" + data + "</span>";
                }
            },
            { "data": "phone_number" },
            { 
                "data": null,
                render: function(data, type, row) 
                {
                    return `<button class="btn btn-primary edit-user" data-bs-toggle="modal" data-bs-target="#editUserModal" data-id="${row.id}"><i class="mdi mdi-pencil"></i></button>`;
                }
            },
            { 
                "data": null,
                render: function(data, type, row) {
                    return `<button class="btn btn-danger" id="delete_user" data-id="${row.id}"><i class="mdi mdi-delete"></i></button>`;
                }
            },
        ]
    });

    $(document).on('click', '.edit-user', function() {
        var id = $(this).data('id');
        $.ajax({
            url: '/api/users/' + id,
            type: 'GET',
            headers: {
                "Authorization": "Bearer " + token
            },
            success: function(user) {
                $('#user_id').val(user.id);
                $('#email').val(user.email);
                $('#phone_number').val(user.phone_number);
                $('#edit_user').attr('data-id', user.id);
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    $('#edit_user').on('click', function() {
        var id = $(this).attr('data-id');
        var user_data = {
            'email' : $('#email').val(),
            'phone_number' : $('#phone').val() + $('#number').val(),
        }
    
        $.ajax({
            url: '/api/users/' + id,
            type: 'PUT',
            headers: {
                "Authorization": "Bearer " + token
            },
            data: user_data,
            success: function(response) {
                alert(response.message);
                $('#editUserModal').modal('hide');
                $('#edit_user_form').trigger('reset');
                $('#all_user').DataTable().ajax.reload();
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    $(document).on('click', '#delete_user', function() {
        var user_id = $(this).data('id');

        if (confirm("Are you sure you want to delete this user?")) {
            $.ajax({
                url: "/api/users/" + user_id,
                type: "DELETE",
                headers: {
                    "Authorization": "Bearer " + token,
                },
                success: function(response) {
                    alert(response.message);
                    $('#all_user').DataTable().ajax.reload();
                },
                error: function(xhr, status, error) {
                    alert(xhr.responseText);
                }
            });
        }
    });

    $('#edit_super_admin_profile').on('click', function() {
        var id = $(this).attr('data-id');

        var imageFile = $('#image')[0].files[0];

        var formData = new FormData();

        if (imageFile) {
            formData.append('image', imageFile);
        }
    
        $.ajax({
            url: '/api/super-admins/' + id,
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