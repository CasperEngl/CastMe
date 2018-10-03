@extends('layouts.master')
@section('content')
@foreach ($users as $user)    
@if ($user->id !== Auth::id())
<h2 class="page-header">{{ $user->name }} {{ $user->last_name }}</h2>
@endif
@endforeach

@if (count($messages) > 0)
  <div class="conversation__container">
    @foreach ($messages as $message)
      @if ($message->user->id === Auth::id())
      <div class="conversation__item right">
      @else
      <div class="conversation__item left">
      @endif
        <a href="{{ route('profile', ['id' => $message->user->id]) }}" class="conversation__user">
          @if ($message->user->id === Auth::id())
          <div class="conversation__user__name">{{ strtoupper(__('you')) }}</div>
          <figure class="conversation__avatar mb-1">
            <img src="{{ Storage::disk('public')->url($user->avatar) }}" alt="">
          </figure>
          @else
          <figure class="conversation__avatar circle mb-1">
            <img src="{{ Storage::disk('public')->url($user->avatar) }}" alt="">
          </figure>
          <div class="conversation__user__name">{{ $message->user->name }} {{ $message->user->last_name }}</div>
          @endif
        </a>
        <div class="conversation__message" title="Message sent {{ Carbon::parse($message->created_at)->format('M j, Y \a\t G:i a') }}">
          <div class="conversation__date">{{ Carbon::parse($message->created_at)->format('M j, Y \a\t G:i a') }}</div>
          {!! $message->content !!}
        </div>
      </div>  
    @endforeach
  </div>
@endif

<div class="h3">{{ ucfirst(__('new message')) }}</div>
<form action="{{ $form_url }}" method="POST">
  <textarea name="content" class="tinymce simple"></textarea>
  <button type="submit" class="btn btn-castme mt-3">{{ ucfirst(__('send')) }}</button>

  @csrf
  @method('POST')
</form>
@endsection