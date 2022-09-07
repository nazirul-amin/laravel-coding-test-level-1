@component('mail::message')
# Event Created

New event is created

@component('mail::panel')
Name    :   {{ $name }} <br>
Slug    :   {{ $slug }}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
