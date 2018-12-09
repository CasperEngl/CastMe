<h1>{{ ucfirst(__('hello')) }}, {{ $user->name }}!</h1>

<p>{{ $sender->name }} {{ __('sent a new message to you.') }}</p>
<p>{{ sentence(__('if you wish to read the conversation, you can click')) }} <a href="{{ env('APP_URL') }}/conversation/{{ $conversation->id }}">{{ __('here') }}</a></p>