@component('mail::message')
# Follow-up Service

Your follow-up booked service with ID: <b>{{ $followup_service->id }}</b> has been set in other schedule.

To view the status of your booking, please click the button below.

@component('mail::button', ['url' => $url])
View Booking
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
