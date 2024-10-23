@component('mail::message')
# Advert Created

Hello,

Your advert titled "**{{ $advert->title }}**" has been successfully created.

@component('mail::button', ['url' => route('advert.view', ['id' => $advert->id])])
View Advert
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
