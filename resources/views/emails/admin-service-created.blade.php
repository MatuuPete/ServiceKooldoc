@component('mail::message')
# Customer Booked

Customer with ID: <b>{{ $service->customer_id }}</b> booked service and has been successfully created with ID: <b>{{ $service->id }}</b>. Admin will verify the booking and for the assigned technicians please standby.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
