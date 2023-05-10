@component('mail::message')
# Customer Follow-up Service

Customer with ID: <b>{{ $followup_service->service->customer_id }}</b>, follow-up service and has been successfully created with follow-up ID: <b>{{ $followup_service->id }}</b>. Admin will reschedule the booking and for the assigned technicians please standby.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
