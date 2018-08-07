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

          <h6 class="text-muted">{{ title_case(__('images')) }}</h6>
          @foreach (json_decode($post->images) as $image)
            <a href="{{ $image }}" class="image-link" target="_blank">{{ preg_replace('/https|http|(:\/\/)|www\.|\/([^\/]*).*$/', '', $image) }}</a>
          @endforeach
        </div>
        <div class="card-footer">
          <a href="/conversations/new/{{ $post->user_id }}" class="card-link btn btn-primary">{{ title_case(__('respond')) }}</a>
          <a href="/poke/{{ $post->user_id }}" class="card-link">{{ title_case(__('poke')) }}</a>
        </div>
      </div>

    </div>
  </div>
</main>
@endsection