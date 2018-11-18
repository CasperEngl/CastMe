<?php

use App\PostRole;

?>

@extends('layouts.master')
@section('content')
@scout
<a href="{{ route('post.new') }}" class="btn btn-castme btn-lg mb-4" role="button">{{ ucfirst(__('new post')) }}</a>
@endscout

<form action="{{ route('posts.search') }}">
  <div class="row">
    <div class="col d-flex">
      <div class="btn-group mr-3">
        <button type="button" class="btn btn-castme dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          {{ ucfirst(__('roles')) }}
        </button>
        <div class="dropdown-menu">
          @foreach (PostRole::getPossibleRoles() as $role)
          <a class="dropdown-item" href="{{ route('posts.search', ['q' => $role]) }}">{{ ucfirst(__(str_replace('_', ' ', $role))) }}</a>                        
          @endforeach
        </div>
      </div>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text" id="post-filter">{{ ucfirst(__('search')) }}</span>
        </div>
        <input type="text" class="form-control bootstrap" placeholder="{{ sentence(__('search by title, content, roles or users')) }}" name="q" aria-label="Search" aria-describedby="post-filter">
      </div>
    </div>
    <div class="col-auto pl-0">
      <button class="btn btn-castme">Search</button>
    </div>
  </div>
</form>
{{-- Check if no posts or all posts are closed --}}
@if (!count($posts))
  <div class="page-header">{{ ucfirst(__('no posts')) }}</div>
@else
  <div class="page-header">{{ $title }}</div>
  <div class="row">
    @foreach($posts as $key => $post)
    <a href="{{ route('post', ['id' => $post->id]) }}" class="post-card__link col-12 col-md-6 animated fadeInRight delay-{{ $key * 100 }}ms">
      <article class="post-card">
        <figure class="post-card__frame">
          <img src="{{ Storage::disk('public')->url($post->banner) }}" alt="{{ strip_tags($post->location) }}" class="post-card__frame__img">
          <div class="post-card__roles">
            @foreach ($post->postRoles->toArray() as $key => $postRole)
            @if ($key === 5)
              @break
            @endif
            <span class="badge badge-pill badge-castme py-2 px-3 my-1 mr-1">{{ strtoupper(__($postRole['role'])) }}</span>
            @endforeach
          </div>
        </figure>
        <div class="post-card__info">
          @if (Auth::check() && Auth::id() === $post->user_id)
          <p class="post-card__author">{{ ucfirst(__('written by')) }} {{ strtoupper(__('you')) }}</p>
          @else
          <p class="post-card__author">{{ ucfirst(__('written by')) }} {{ $post->owner->name }}</p>
          @endif
          <h2 class="post-card__title">{{ str_limit(title_case($post->title), 40) }}</h2>
        </div>
      </article>
    </a>
    @endforeach
  </div>
@endif

@endsection