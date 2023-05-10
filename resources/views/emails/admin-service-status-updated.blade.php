@component('mail::message')
# Service Status Updated

Customer with ID: <b>{{ $service->customer_id }}</b> and booked service with ID: <b>{{ $service->id }}</b> has been updated to <b>{{ ucwords($service->service_status) }}</b> status.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
