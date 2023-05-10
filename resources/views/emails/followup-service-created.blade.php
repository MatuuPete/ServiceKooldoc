@component('mail::message')
# Follow-up Service

Your follow-up booked service has been successfully created with follow-up ID: <b>{{ $followup_service->id }}</b>. The admin will now reschedule it.

To view the status of your booking, please click the button below.

@component('mail::button', ['url' => $url])
View Booking
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
