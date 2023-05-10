@component('mail::message')
# Customer Follow-up Schedule

Customer with ID: <b>{{ $followup_service->service->customer_id }}</b>, follow-up service with follow-up ID: <b>{{ $followup_service->id }}</b> has been set in other schedule.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
