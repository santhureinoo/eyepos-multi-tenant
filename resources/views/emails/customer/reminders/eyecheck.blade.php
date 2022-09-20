@component('mail::message')
# Hi {{ $customer->first_name }},

This is your friendly reminder to get your eyes checked!
Please come and see us soon! <3

Thanks,<br>
{{ config('app.name') }}
@endcomponent
