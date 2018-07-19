@extends('master')
@section('content')
  <main class="container">
    <div class="row">

      @foreach($posts as $post)

        <div class="col-md-4">
          <article class="card post-card">
            <figure class="card-img-top">
              <img src="{{ asset('img/placeholder-wallpaper.jpg') }}" alt="">
            </figure>
            <section class="card-body">
              <h4 class="card-title">{{ title_case($post->title) }}</h4>
              <h6 class="card-subtitle mb-2 text-muted">{{ title_case(__('Written by')) }} {{ $post->owner->name }}</h6>
              <p class="card-text">{{ str_limit(strip_tags($post->content), 150, '...') }}</p>
              <a href="/message/{{ $post->id }}" class="card-link">{{ title_case(__('Contact scout')) }}</a>
              <a href="#!" class="card-link" data-toggle="modal" data-target="#post-{{ $post->id }}">{{ title_case(__('Read more')) }}</a>
            </section>
          </article>

          <div class="modal" id="post-{{ $post->id }}">
            <div class="modal-dialog">
              <div class="modal-content">
          
                <!-- Modal Header -->
                <div class="modal-header">
                  <h4 class="modal-title">{{ title_case($post->title) }}</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
          
                <div class="modal-body">
                  <h5 class="mb-2 text-muted">{{ title_case(__('Written by')) }} {{ $post->owner->name }}</h5>

                  {{ $post->content }}

                  <a href="https://i.imgur.com/rh5O7wN.jpg" class="modal-link" target="_blank">imgur.com</a>
                  <a href="https://i.imgur.com/nScazCd.jpg" class="modal-link" target="_blank">imgur.com</a>
                  <a href="https://i.imgur.com/avnhoaZ.jpg" class="modal-link" target="_blank">imgur.com</a>
                </div>
                
                <!-- Modal footer -->
                <div class="modal-footer">
                  <a href="/message/{{ $post->id }}" class="btn btn-primary">Contact Scout</a>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
          
              </div>
            </div>
          </div>
        </div>

        @endforeach

    </div>
  </main>
@endsection