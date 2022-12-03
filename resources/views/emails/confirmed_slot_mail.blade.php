@component('mail::message')
CONGRATULATIONS {{ $name }} ! <br>

{{$body1}} <br>
{{ $body2 }}<br>
@component('mail::button', ['url' => $url])
Go to Website
@endcomponent <br>
 

Best Regards,<br>
Email    :<br> 
contact.aeointernational@gmail.com<br>
contact.aeointernational@gmail.com <br>
<img src="https://aeo.mybnec.org/storage/assets/AEO-2023-Colored.png" alt="" width="50%"> <br>
{{ config('app.name') }} <br>
Jakarta | Indonesia <br>
Website : www.aeo.mybnec.org <br>
@endcomponent
