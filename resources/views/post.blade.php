@extends('master')
@section('content')
<main class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">

      {{ $post }}
      
      <div class="card">
        <div class="card-header">
          <h4>{{ title_case($post->title) }}</h4>
        </div>
        <div class="card-body">
          <h5 class="text-muted">{{ title_case(__('written by')) }} {{ $post->owner->name }}</h5>

          <div class="mt-4 mb-4">
            {!! $post->content !!}
          </div>

          @if (json_decode($post->images)[0] !== null)
            <h6 class="text-muted">{{ title_case(__('images')) }}</h6>
          @endif
          @foreach (json_decode($post->images) as $image)
            <a href="{{ $image }}" class="image-link" target="_blank">{{ preg_replace('/https|http|(:\/\/)|www\.|\/([^\/]*).*$/', '', $image) }}</a>
          @endforeach
        </div>
        <div class="card-footer">
          <div class="row justify-content-between">
            <div class="col-auto">
              <a href="/conversations/new/{{ $post->user_id }}" class="card-link btn btn-primary">{{ title_case(__('respond')) }}</a>
              <a href="/poke/{{ $post->user_id }}" class="card-link">{{ title_case(__('poke')) }}</a>
            </div>
            @if (Auth::user()->id === $post->user_id)
            <div class="col-auto">
              <a href="/post/{{ $post->id }}/edit" class="card-link btn btn-success">{{ title_case(__('edit')) }}</a>
            </div>
            @endif
          </div>
        </div>
      </div>

    </div>
  </div>
</main>
@endsection