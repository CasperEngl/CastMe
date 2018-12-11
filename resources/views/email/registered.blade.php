<h1>{{ ucfirst(__('hello')) }}, {{ $user->name }}!</h1>

<p>{{ $registrant->name }} {{ $registrant->last_name }} {{ __('registered you.') }}</p>
<p>{{ sentence(__('to log in, please reset your password')) }} <a href="{{ env('APP_URL') }}/password/reset/">{{ __('here') }}</a></p>