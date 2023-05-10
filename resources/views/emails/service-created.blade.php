@component('mail::message')
# Service Booked

Your booked service has been successfully created with ID: <b>{{ $service->id }}</b>. The admin will now verify it.

To view the status of your booking, please click the button below.

@component('mail::button', ['url' => $url])
View Booking
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
