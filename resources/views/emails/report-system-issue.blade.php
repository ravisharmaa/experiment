@component('mail::message')
# Critical System Issue
Hi! **Sys Admin**,<br>
While regular checkup, few issues were found on system.

@component('mail::panel')
    **Ip Address**: {{ $data['ipAddress'] }} <br>
    **Host Name** : {{ $data['hostName'] }} <br>
    **Message**
    @foreach($data['messages'] as $value)
        + {{ $value }}
    @endforeach


@endcomponent

Thanks,<br>
{{ config('app.name') }} <br>
Javra Software Nepal
@endcomponent
