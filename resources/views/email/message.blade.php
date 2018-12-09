<h1>{{ ucfirst(__('hello')) }}, {{ $user->name }}!</h1>

<p>{{ $sender->name }} {{ __('sent a new message to you.') }}</p>
<p>{{ sentence(__('if you wish to read the conversation, you can click')) }} <a href="{{ env('APP_URL') }}/conversation/{{ $conversation->id }}">{{ __('here') }}</a></p>

<p>{{ sentence(__('in case the link above doesn\'t work, try copy and pasting the following link into your browser address bar.')) }}</p>
<p>{{ env('APP_URL') }}/conversation/{{ $conversation->id }}</p>