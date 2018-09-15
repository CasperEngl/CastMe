@extends('layouts.master')
@section('content')
<h2 class="page-header">{{ ucfirst(__('conversation')) }}</h2>

@if ($messages->count() > 0)
  <div class="card">
    @foreach($messages as $message)
      <div class="card-header">
        @if($message->user->id === Auth::id())
          {{ strtoupper(__('you')) }}
        @else
          {{ $message->user->name }}
        @endif
      </div>
      <div class="card-block">
        <p>
          {!! sentence($message->content) !!}
        </p>
      </div>
      @endforeach
  </div>
@else
  <p>{{ Format }}</p>
@endif

<form class="mt-4" action="{{ $form_url }}" method="POST">
  <textarea name="content" class="tinymce"></textarea>
  <button type="submit" class="btn btn-primary mt-2">{{ ucfirst(__('send')) }}</button>

  @csrf
  @method('POST')
</form>
@endsection