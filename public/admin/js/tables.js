$(document).ready(function (){
    const token = localStorage.getItem('access_token');

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
            url :"/api/multi-tables",
            type: "GET",
            headers: {
                "Authorization": "Bearer " + token
            },
            dataSrc: "transaction_cancelled_table",
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

    $('#all_pending_transaction').DataTable({
        dom: 'Blfrtip',
        buttons: [
            'excel',
            'csv',
            'pdf',
            'copy'
        ],
        ajax: 
        {
            url :"/api/multi-tables",
            type: "GET",
            headers: {
                "Authorization": "Bearer " + token
            },
            dataSrc: "transaction_pending_table",
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

    $('#all_processing_transaction').DataTable({
        dom: 'Blfrtip',
        buttons: [
            'excel',
            'csv',
            'pdf',
            'copy'
        ],
        ajax: 
        {
            url :"/api/multi-tables",
            type: "GET",
            headers: {
                "Authorization": "Bearer " + token
            },
            dataSrc: "transaction_processing_table",
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

    $('#all_failed_transaction').DataTable({
        dom: 'Blfrtip',
        buttons: [
            'excel',
            'csv',
            'pdf',
            'copy'
        ],
        ajax: 
        {
            url :"/api/multi-tables",
            type: "GET",
            headers: {
                "Authorization": "Bearer " + token
            },
            dataSrc: "transaction_failed_table",
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

    $('#all_success_transaction').DataTable({
        dom: 'Blfrtip',
        buttons: [
            'excel',
            'csv',
            'pdf',
            'copy'
        ],
        ajax: 
        {
            url :"/api/multi-tables",
            type: "GET",
            headers: {
                "Authorization": "Bearer " + token
            },
            dataSrc: "transaction_success_table",
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
            url :"/api/multi-tables",
            type: "GET",
            headers: {
                "Authorization": "Bearer " + token
            },
            dataSrc: "service_cancelled_table",
        },
        responsive: true,
        columns: [      
            { "data": "id" },
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
        ],
    });

    $('#all_checking_service').DataTable({
        dom: 'Blfrtip', 
        buttons: [
            'excel',
            'csv',
            'pdf',
            'copy'
        ],
        ajax: 
        {
            url :"/api/multi-tables",
            type: "GET",
            headers: {
                "Authorization": "Bearer " + token
            },
            dataSrc: "service_checking_table",
        },
        responsive: true,
        columns: [      
            { "data": "id" },
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
        ],
    });

    $('#all_pending_service').DataTable({
        dom: 'Blfrtip', 
        buttons: [
            'excel',
            'csv',
            'pdf',
            'copy'
        ],
        ajax: 
        {
            url :"/api/multi-tables",
            type: "GET",
            headers: {
                "Authorization": "Bearer " + token
            },
            dataSrc: "service_pending_table",
        },
        responsive: true,
        columns: [      
            { "data": "id" },
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
        ],
    });
    
    $('#all_followup_service').DataTable({
        dom: 'Blfrtip', 
        buttons: [
            'excel',
            'csv',
            'pdf',
            'copy'
        ],
        ajax: 
        {
            url :"/api/multi-tables",
            type: "GET",
            headers: {
                "Authorization": "Bearer " + token
            },
            dataSrc: "service_followup_table",
        },
        responsive: true,
        columns: [      
            { "data": "id" },
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
            { "data": "followup_id" },
            { "data": "reason" },
            { "data": "followup_date" },
            { "data": "followup_time" },
            { "data": "followup_status" },
        ],
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
            url :"/api/multi-tables",
            type: "GET",
            headers: {
                "Authorization": "Bearer " + token
            },
            dataSrc: "service_finished_table",
        },
        responsive: true,
        columns: [      
            { "data": "id" },
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
            { "data": "followup_id" },
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
        ],
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
            url :"/api/multi-tables",
            type: "GET",
            headers: {
                "Authorization": "Bearer " + token
            },
            dataSrc: "service_completed_table",
        },
        responsive: true,
        columns: [      
            { "data": "id" },
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
            { "data": "followup_id" },
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
        ],
    });
});