@component('mail::message')
# Contact Us

Full Name: <b>{{ $data['full_name'] }}</b>
<br>
<br>
Email: <b>{{ $data['email'] }}</b>
<br>
<br>
Contact Number: <b>{{ $data['contact_number'] }}</b>
<br>
<br>
Inquiry: <b>{{ ucwords($data['inquiry']) }}</b>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
