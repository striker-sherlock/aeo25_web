@component('mail::message')
# Dear {{ $questionNotificationMail['division'] }},

{!! $questionNotificationMail['body'] !!}

@component('mail::button', ['url' => $questionNotificationMail['link'], 'color' => 'primary'])
Go to Website
@endcomponent

Best Regards,<br>
Email    :<br> 
contact.aeointernational@gmail.com<br>
contact.aeointernational@gmail.com <br>
<img src="https://aeo.mybnec.org/storage/assets/AEO-2023-Colored.png" alt="" width="50%"> <br>
{{ config('app.name') }} <br>
Jakarta | Indonesia <br>
Website : www.aeo.mybnec.org <br>
@endcomponent
