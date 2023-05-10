@component('mail::message')
# Follow-up Service Status Updated

Your follow-up booked service with follow-up ID: <b>{{ $followup_service->id }}</b> has been updated to <b>{{ ucwords($followup_service->followup_status) }}</b> status.

To view your updated booking, please click the button below.

@component('mail::button', ['url' => $url])
View Booking
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
