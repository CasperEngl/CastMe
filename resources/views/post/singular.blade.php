<?php

use App\Helpers\Format;

?>

@extends('layouts.master')
@section('content')
<div class="card">
  <div class="card-header">
    <h4>{{ title_case($post->title) }}</h4>
  </div>
  <figure class="card-img-top">
    <img src="{{ Storage::disk('public')->url($post->banner) }}" alt="Card image cap">
  </figure>
  <div class="card-body">
    @if (Auth::user()->id === $post->user_id)
      <h5 class="text-muted">{{ ucfirst(__('written by')) }} {{ strtoupper(__('you')) }}</h5>
    @else
      <h5 class="text-muted">{{ ucfirst(__('written by')) }} {{ $post->owner->name }}</h5>
    @endif

    <div class="my-4">
      {!! $post->content !!}
    </div>

    @if (json_decode($post->images)[0] !== null)
      <h6 class="text-muted">{{ title_case(__('images')) }}</h6>
      @foreach (json_decode($post->images) as $image)
      <a href="{{ $image }}" class="image-link" target="_blank">{{ Format::stripDomain($image) }}</a>
      @endforeach
    @endif
  </div>
  @if (Auth::user()->id === $post->user_id)
  <div class="card-footer">
    <div class="row">
      <div class="col-auto ml-auto">
        <a href="/post/{{ $post->id }}/edit" class="card-link btn btn-success">{{ title_case(__('edit')) }}</a>
      </div>
    </div>
  </div>
  @endif
</div>

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