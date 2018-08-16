@extends('layouts.master')
@section('content')
<main class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      
      <div class="card">
        <div class="card-header">
          <h4>{{ title_case($post->title) }}</h4>
        </div>
        <figure class="card-img-top">
          <img src="{{ asset('img/hero.jpg') }}" alt="Card image cap">
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
          @endif
          @foreach (json_decode($post->images) as $image)
            <a href="{{ $image }}" class="image-link" target="_blank">{{ preg_replace('/https|http|(:\/\/)|www\.|\/([^\/]*).*$/', '', $image) }}</a>
          @endforeach
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

      @if (Auth::user()->id === $post->user_id)
      <h2 class="page-header mb-0">{{ title_case(__('comments')) }}</h2>

      <div class="card my-3">
        <div class="card-header">Casper Engelmann</div>
        <div class="card-body">
          hello world!
        </div>
        <div class="card-footer">
          <div class="row align-items-center">
            <div class="col">{{ Carbon\Carbon::now()->toDateTimeString() }}</div>
            <div class="col-auto">
              <a href="/conversation/1" class="btn btn-primary">{{ ucfirst(__('message')) }}</a>
            </div>
          </div>
        </div>
      </div>
      <div class="card my-3">
        <div class="card-header">Jonatan Nielsen</div>
        <div class="card-body">
          fuck mac
        </div>
        <div class="card-footer">
          <div class="row">
            <div class="col">
              {{ Carbon\Carbon::now()->toDateTimeString() }}
            </div>
            <div class="col-auto">
              <a href="/conversation/1" class="btn btn-primary">{{ ucfirst(__('message')) }}</a>
            </div>
          </div>
        </div>
      </div>
      @else
      <form action="" method="POST">
        <h2 class="page-header mb-0">{{ ucfirst(__('send a message')) }}</h2>
        <textarea name="content" class="tinymce"></textarea>
        <button class="btn btn-primary" type="submit">{{ title_case(__('message')) }}</button>

        @csrf
        @method('POST')
      </form>
      @endif

    </div>
  </div>
</main>
@endsection