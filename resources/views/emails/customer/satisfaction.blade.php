@component('mail::message')
# Thank you!

We appreciate your business! Please leave us some feedback!

@component('mail::button', ['url' => $url])
Feedback Survey
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
