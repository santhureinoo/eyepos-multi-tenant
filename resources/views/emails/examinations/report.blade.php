@component('mail::message')
# Hi {{ $examination->customer->first_name }},

Please find attached your examination results.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
