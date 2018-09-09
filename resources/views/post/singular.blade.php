<?php

use App\Helpers\Format;

?>

@extends('layouts.master')
@section('content')
<article class="post-article">
  <div class="d-flex flex-column align-items-center">
    <h6 class="post-article__date">{{ Carbon::parse($post->created_at)->toFormattedDateString() }}</h6>
    @if (Carbon::parse($post->created_at)->timestamp !== Carbon::parse($post->updated_at)->timestamp)
    <p class="text-muted"><em>{{ ucfirst(__('updated at')) }} {{ Carbon::parse($post->updated_at)->toDateTimeString() }}</em></p>
    @endif
    <h1 class="post-article__title">{{ title_case($post->title) }}</h1>
    <blockquote class="post-article__quote">
      <figure class="post-article__quote__avatar">
        <img src="{{ Storage::disk('public')->url($post->owner->avatar) }}" alt="">
      </figure>
      <p class="post-article__quote__name">{{ $post->owner->name }} {{ $post->owner->last_name }}</p>
    </blockquote>
    @if ($post->roles)
    <div class="d-flex align-items-center my-3">
      @foreach (json_decode($post->roles) as $role)
      <span class="badge badge-pill badge-primary py-2 px-3 mx-1">{{ strtoupper($role) }}</span> @endforeach
    </div>
    @endif
    <figure class="post-article__frame">
      <img src="{{ Storage::disk('public')->url($post->banner) }}" alt="" class="post-article__frame__img">
    </figure>

    <div class="container mt-3">      
      {!! $post->content !!}

      <div class="d-flex flex-column">
      @if ($post->images)
        <h6 class="text-muted mt-4">{{ ucfirst(__('images')) }}</h6>
        @foreach (json_decode($post->images) as $image)
        <a href="{{ $image }}" target="_blank">{{ Format::stripDomain($image) }}</a>
        @endforeach
      @endif
      </div>
    </div>
  </div>
</article>

<hr class="my-5">

@if ($owner)
  @if (count($comments) > 0)
    <h2 class="page-header mb-0">{{ title_case(__('comments')) }}</h2>
    @foreach ($comments as $comment)
    <div class="card my-3">
      {{ Auth::id() === $comment->owner }}
      <div class="card-header">{{ $comment->owner->name }} {{ $comment->owner->last_name }}</div>
      <div class="card-body">
        {{ strip_tags($comment->content) }}
      </div>
      <div class="card-footer">
        <div class="row align-items-center">
          <div class="col">{{ Carbon::parse($comment->updated_at)->format('M j \a\t G:i') }}</div>
          <div class="col-auto">
            <a href="{{ route('conversation', ['id' => $comment->user_id]) }}" class="btn btn-primary">{{ ucfirst(__('message')) }}</a>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  @else
  {{-- If nocomments are found --}}
  <h2 class="page-header mb-0">{{ title_case(__('No comments')) }}</h2>
  @endif
@else
  @foreach ($comments as $comment)
    @if (Auth::id() === $comment->user_id)
    <div class="card my-3">
      {{ Auth::id() === $comment->owner }}
      <div class="card-header">{{ strtoupper(__('you')) }}</div>
      <div class="card-body">
        {{ strip_tags($comment->content) }}
      </div>
      <div class="card-footer">
        <div class="row align-items-center">
          <div class="col">{{ Carbon::parse($comment->updated_at)->format('M j \a\t G:i') }}</div>
          <div class="col-auto">
            <a href="{{ route('conversation', ['id' => $comment->user_id]) }}" class="btn btn-primary">{{ ucfirst(__('message')) }}</a>
          </div>
        </div>
      </div>
    </div>
    @endif
  @endforeach
  <form action="{{ route('comment.new') }}" method="POST">
    <h2 class="page-header mb-0">{{ ucfirst(__('comment')) }}</h2>
    <textarea name="content" class="tinymce"></textarea>
    <button class="btn btn-primary" type="submit">{{ title_case(__('comment')) }}</button>

    {{ Form::hidden('post', $post->id) }}
    
    @csrf
    @method('POST')
  </form>
@endif
@endsection