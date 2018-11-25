@component('mail::message')
# Notification

Нажмите на кнопку ниже, чтобы просмотреть договор
{{--todo have to change the url--}}
@component('mail::button', ['url' => URL::to('/').':4200/offer-result-from-peer/'.$offer->id])
    Просмотреть Договор
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent