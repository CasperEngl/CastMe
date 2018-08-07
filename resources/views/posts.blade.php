@extends('master')
@section('content')
  <main class="container">
    <div class="row">

      @foreach($posts as $post)

        <div class="col-md-4">
          <article class="card post-card">
            <section class="card-body">
              <h4 class="card-title">{{ title_case($post->title) }}</h4>
              <h6 class="card-subtitle mb-2 text-muted">{{ title_case(__('written by')) }} {{ $post->owner->name }}</h6>
              <p class="card-text">{{ str_limit(strip_tags($post->content), 150, '...') }}</p>
              <a href="/message/{{ $post->id }}" class="card-link">{{ title_case(__('contact scout')) }}</a>
              <a href="/post/{{ $post->id }}" class="card-link">{{ title_case(__('read more')) }}</a>
            </section>
          </article>
        </div>

        @endforeach

    </div>
  </main>
@endsection