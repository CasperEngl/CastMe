@extends('layouts.master')
@section('content')

@if (!count($conversations))
<h2 class="page-header">{{ ucfirst(__('no conversations')) }}</h2>
@else
<h2 class="page-header">{{ ucfirst(__('conversations')) }}</h2>

<div class="list-group">
  @foreach ($conversations as $conversation)
  <a href="{{ route('conversation', ['id' => $conversation->id]) }}" class="conversation list-group-item d-flex align-items-center justify-content-between">
    @foreach($conversation->users as $user)
      @if ($user->id !== Auth::id())
        <div class="d-flex align-items-center">
          <figure class="conversation__avatar mr-2">
            <img src="{{ Storage::disk('public')->url($user->avatar) }}" alt="">
          </figure>
          <div class="conversation__user">{{ $user->name }} {{ $user->last_name }}</div>
          @if ($conversation->new(Auth::id()))
            <span class="badge badge-danger ml-1">{{ $conversation->new(Auth::id()) }} {{ __('unread') }}</span>
          @endif
        </div>
        <div class="conversation__sneakpeak d-none d-sm-block"><i class="fas fa-comment"></i> {{ str_limit(strip_tags($conversation->messages()->latest()->get()[0]->content), 30, '...') }}</div>
      @endif
    @endforeach
  </a>
  @endforeach
</div>
@endif

@endsection