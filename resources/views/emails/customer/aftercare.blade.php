@component('mail::message')
# Hi {{ $customer->first_name }},

Thank you for doing business with us. You're optometrist has left you a message.

_{{ $body }}_

## Thanks,<br>
{{ config('app.name') }}
@endcomponent
