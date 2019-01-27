@component('mail::message')
# Notification

Нажмите на кнопку ниже, дайте оценку,
{{--todo have to change the url--}}
@component('mail::button', ['url' => URL::to('/').':4200/write-review/'.$offer->id])
  оцените
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
