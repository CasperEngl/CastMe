@extends('layouts.master')
@section('content')
<article class="post-article">
  <div class="d-flex flex-column align-items-center">
    <hgroup class="d-flex flex-column align-items-center">
      <h5 class="post-article__date">{{ Carbon::parse($post->created_at)->format('M j, Y \a\t G:i a') }}</h5>
      @if (Carbon::parse($post->created_at)->timestamp !== Carbon::parse($post->updated_at)->timestamp)
      <h6 class="text-muted"><em>{{ ucfirst(__('updated')) }} {{ Carbon::parse($post->updated_at)->format('M j, Y \a\t G:i a') }}</em></h6>
      @endif
      <h1 class="post-article__title">{{ title_case($post->title) }}</h1>
    </hgroup>
    <a href="{{ route('profile', ['id' => $post->owner->id]) }}" class="post-article__profile-link">
      <blockquote class="post-article__quote">
        <figure class="post-article__quote__avatar">
          <img src="{{ Storage::disk('public')->url($post->owner->avatar) }}" alt="">
        </figure>
        <p class="post-article__quote__name">{{ $post->owner->name }} {{ $post->owner->last_name }}</p>
      </blockquote>
    </a>
    <div class="post-article__container">
      <figure class="post-article__frame">
        <img src="{{ Storage::disk('public')->url($post->banner) }}" alt="" class="post-article__frame__img">
      </figure>
  
      @if ($owner || Auth::user() && in_array(Auth::user()->role, ['Admin', 'Moderator']))
      <section class="my-2 align-self-start">
        <a href="{{ route('post.edit', ['id' => $post->id]) }}" class="btn btn-info">{{ ucfirst(__('edit')) }}</a>
        @if ($post->closed)
        <a href="{{ route('post.toggle', ['id' => $post->id]) }}" class="btn btn-warning">{{ ucfirst(__('release')) }}</a>
        @else
        <a href="{{ route('post.toggle', ['id' => $post->id]) }}" class="btn btn-danger">{{ ucfirst(__('disable')) }}</a>
        @endif
      </section>
      @endif
      <section class="row align-items-center justify-content-center my-3">
        @if ($post->location)
        <div class="col-auto">
          <h3 class="post-article__location">{{ $post->location }}</h3>
        </div>
        @endif
        @if ($post->roles)
        <div class="col">
          @foreach (json_decode($post->roles) as $role)
          <span class="badge badge-pill badge-castme py-2 px-3 my-1 mx-1">{{ strtoupper(__($role)) }}</span> @endforeach
          @endif
        </div>
      </section>
  
      <section class="post-article__content">      
        {!! $post->content !!}
  
        <div class="d-flex flex-column">
        @if (is_array($post->images))
          <h5 class="text-muted mt-4">{{ ucfirst(__('images')) }}</h5>
          @foreach (json_decode($post->images) as $image)
          <a href="{{ $image }}" target="_blank">{{ Format::stripDomain($image) }}</a>
          @endforeach
        @endif
        </div>
      </section>
    </div>
  </div>
</article>

<hr class="my-5">

@if (count($comments))
  @foreach ($comments as $comment)
  @if (Auth::user() && Auth::id() === $post->owner->id || Auth::user() && Auth::id() === $comment->user_id)
  <div class="comment__container">
      <div class="comment__item">
        <a href="{{ route('profile', ['id' => $comment->owner->id]) }}" class="comment__user">
          <figure class="comment__avatar circle mb-1">
            <img src="{{ Storage::disk('public')->url($comment->owner->avatar) }}" alt="">
          </figure>
          <div class="comment__user__name">{{ $comment->owner->name }} {{ $comment->owner->last_name }}</div>
        </a>
        <div class="comment__message" title="Message sent {{ Carbon::parse($comment->updated_at)->format('M j \a\t G:i') }}">
          <div class="row align-items-center">
            <div class="col">
              <div class="comment__content">{{ strip_tags($comment->content) }}</div>
              <div class="comment__date">{{ Carbon::parse($comment->created_at)->format('M j \a\t G:i') }}</div>
            </div>
            @if (Auth::user() && Auth::id() === $post->owner->id)
            <div class="col-auto">
              <form action="{{ route('conversation.new') }}" method="post">
                @csrf
                <input type="hidden" name="users[]" value="{{ Auth::id() }}">
                <input type="hidden" name="users[]" value="{{ $comment->user_id }}">
                <input type="submit" class="btn btn-castme" value="{{ ucfirst(__('message')) }}">
              </form>
            </div>
            @endif
          </div>
        </div>
      </div>
  </div>
  @endif
  @endforeach
@endif

@if (Auth::user() && Auth::id() !== $post->owner->id)
@paid
<form action="{{ route('comment.new') }}" method="POST">
  <div class="h3">{{ ucfirst(__('comment')) }}</div>
  <textarea name="content" class="tinymce simple"></textarea>
  <button class="btn btn-castme mt-2" type="submit">{{ ucfirst(__('comment')) }}</button>

  {{ Form::hidden('post', $post->id) }}
  
  @csrf
  @method('POST')
</form>
@else
  @free
  <a href="{{ route('user.subscription') }}" class="btn btn-lg btn-castme">{{ sentence(__('start your subscription to contact scout')) }}</a>
  @else
  <a href="{{ route('login') . '?previous=' . Request::fullUrl() }}" class="btn btn-lg btn-castme">{{ sentence(__('Login to contact scout')) }}</a>
  @endfree
@endpaid
@endif
@endsection