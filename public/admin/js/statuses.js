$(document).ready(function (){
    const token = localStorage.getItem('access_token');

    $.ajax({
        url: '/api/multi-statuses',
        type: 'GET',
        headers: {
            "Authorization": "Bearer " + token
        },
        success: function(response) {
            $('#transaction_cancelled_status').text(response.transaction_cancelled_count);
            $('#transaction_pending_status').text(response.transaction_pending_count);
            $('#transaction_processing_status').text(response.transaction_processing_count);
            $('#transaction_failed_status').text(response.transaction_failed_count);
            $('#transaction_success_status').text(response.transaction_success_count);

            $('#service_cancelled_status').text(response.service_cancelled_count);
            $('#service_checking_status').text(response.service_checking_count);
            $('#service_pending_status').text(response.service_pending_count);
            $('#service_followup_status').text(response.service_followup_count);
            $('#service_finished_status').text(response.service_finished_count);
            $('#service_completed_status').text(response.service_completed_count);
        },
        error: function(xhr, status, error) {
            alert(xhr.responseText);
        }
    });
});