@component('mail::message')
# Hello, {{$user['name']}}

Your Registration is successful. <br>
@if($user['reg_no'])
<strong>Registration Number : </strong> {{$user['reg_no']}} <br>
<strong>Roll Number : </strong> {{$userDetail['roll']}} <br>
@endif
<strong>Contact Number: </strong> {{$user['phone']}}<br>
<strong>Your DOB is your password. Please change your password & set your own.</strong>

@component('mail::button', ['url' => URL::to('/login')])
Click To Login
@endcomponent
<small>Use your Registration Number/Phone Number/E-mail address as user name to login.</small>
<br>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
