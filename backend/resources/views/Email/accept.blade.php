@component('mail::message')
# Change password Request

Click on the button below to change password
{{--todo have to change the url--}}
@component('mail::button', ['url' => URL::to('/').':4200/response-password-reset?token='.$token])
    Reset Password
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent