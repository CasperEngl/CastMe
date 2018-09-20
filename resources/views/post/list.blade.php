@extends('layouts.master')
@section('content')
@scout
<a href="{{ route('post.new') }}" class="btn btn-primary btn-lg mb-4" role="button">{{ ucfirst(__('new job post')) }}</a>
@endscout

{{-- Check if no posts or all posts are closed --}}
@if (empty(array_filter(json_decode($posts), function ($post) {
  return $post->closed === 0;
})))
  <div class="page-header">{{ ucfirst(__('no posts')) }}</div>
@else
  <div class="page-header">{{ $title }}</div>
  <div class="row">
    @foreach($posts as $key => $post)
      @if (!$post->closed || $own)
      <a href="{{ route('post', ['id' => $post->id]) }}" class="post-card__link col-12 col-md-6 animated fadeInRight delay-{{ $key * 100 }}ms">
        <article class="post-card">
          <figure class="post-card__frame">
            <img src="{{ Storage::disk('public')->url($post->banner) }}" alt="{{ strip_tags($post->content) }}" class="post-card__frame__img">
            <div class="post-card__roles">
              @foreach (json_decode($post->roles) as $key => $role)
              @if ($key === 5)
                @break
              @endif
              <span class="badge badge-pill badge-primary py-2 px-3 my-1 mr-1">{{ strtoupper(__($role)) }}</span>
              @endforeach
            </div>
          </figure>
          <div class="post-card__info">
            @if (Auth::user()->id === $post->user_id)
            <p class="post-card__author">{{ ucfirst(__('written by')) }} {{ strtoupper(__('you')) }}</p>
            @else
            <p class="post-card__author">{{ ucfirst(__('written by')) }} {{ $post->owner->name }}</p>
            @endif
            <h2 class="post-card__title">{{ str_limit(title_case($post->title), 40) }}</h2>
          </div>
        </article>
      </a>
      @endif
    @endforeach
  </div>
@endif

@endsection