@extends('layouts.master')
@section('content')
  <main class="container">
    @if(in_array(Auth::user()->role, ['Scout', 'Moderator', 'Admin']))
    <a href="{{ route('post.new') }}" class="btn btn-primary btn-lg mb-4" role="button">{{ ucfirst(__('new post')) }}</a>
    @endif

    <div class="row">

      @foreach($posts as $post)

        <div class="col-md-4 mt-2 mb-2">
          <article class="card h-100">
            <section class="card-body d-flex flex-wrap">
              <h4 class="card-title w-100">{{ title_case($post->title) }}</h4>
              @if (Auth::user()->id === $post->user_id)
                <h6 class="card-subtitle w-100 mb-2 text-muted">{{ ucfirst(__('written by')) }} {{ strtoupper(__('you')) }}</h6>
              @else
                <h6 class="card-subtitle w-100 mb-2 text-muted">{{ ucfirst(__('written by')) }} {{ $post->owner->name }}</h6>
              @endif
              <p class="card-text w-100">{{ str_limit(strip_tags($post->content), 150, '...') }}</p>
            </section>
            <section class="card-footer d-flex flex-wrap align-items-center justify-content-center">
              <a href="{{ route('conversation', ['id' => $post->owner->id]) }}" class="card-link btn btn-link">{{ ucfirst(__('contact scout')) }}</a>
              <a href="/post/{{ $post->id }}" class="card-link btn btn-link">{{ ucfirst(__('read more')) }}</a>
              @if (Auth::user()->id === $post->user_id)
              <a href="/post/{{ $post->id }}/edit" class="d-block w-100 mt-2 card-link btn btn-success">{{ ucfirst(__('edit')) }}</a>
              @endif
            </section>
          </article>
        </div>

      @endforeach

    </div>
  </main>
@endsection