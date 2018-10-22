@component('mail::message')
# Change password Request

Click on the button below to change password
{{--todo--}}
@component('mail::button', ['url' => App::environment('APP_URL').':'.App::environment('APP_PORT').'/response-password-reset?token='.$token])
    Reset Password
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent