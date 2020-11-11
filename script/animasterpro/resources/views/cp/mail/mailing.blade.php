@component('mail::message')
Thanks for your message

<strong>{{$data['adminreply']}}</strong>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
