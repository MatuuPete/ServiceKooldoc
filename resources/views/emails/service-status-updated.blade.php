@component('mail::message')
# Service Status Updated

Your booked service with ID: <b>{{ $service->id }}</b> has been updated to <b>{{ ucwords($service->service_status) }}</b> status.

To view your updated booking, please click the button below.

@component('mail::button', ['url' => $url])
View Booking
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
