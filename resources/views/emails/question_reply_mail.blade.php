@component('mail::message')
# Dear, {{ $name }}

<b>Your Question:</b><br>
{{ $question }}
<br><br>
<b>Answer:</b><br>
{!! $body !!}

Best Regards,<br>
Email    :<br> 
contact.aeointernational@gmail.com<br>
contact.aeointernational@gmail.com <br>
<img src="https://aeo.mybnec.org/storage/assets/AEO-2023-Colored.png" alt="" width="50%"> <br>
{{ config('app.name') }} <br>
Jakarta | Indonesia <br>
Website : www.aeo.mybnec.org <br>
@endcomponent
