@component('mail::message')
# Follow-up Service Status Updated

Customer with ID: <b>{{ $followup_service->service->customer_id }}</b> and follow-up booked service with follow-up ID: <b>{{ $followup_service->id }}</b> has been updated to <b>{{ ucwords($followup_service->followup_status) }}</b> status.

To view the updated booking, please click the button below.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
