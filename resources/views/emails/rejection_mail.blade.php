@component('mail::message')
 Dear {{ $name }}, <br>
 {{ $body1 }} <br>
{!!$reason!!} <br>

{{ $body2 }} <br>

@component('mail::button', ['url' => $url])
Go to Website
@endcomponent <br>
 
Best Regards,<br>
Someone's Name (Ms.) <br>
Staff of Fundraising Division <br>
Phone    : +62-812-8355-2223 <br>
Email    : someone's_email@binus.ac.id <br>
<img src="https://socialevent.mybnec.org/storage/images/assets/AEO-2023Colored.png" alt="" width="50%"> <br>
{{ config('app.name') }} <br>
Jakarta | Indonesia <br>
Website : www.socialevent.mybnec.org <br>
@endcomponent
