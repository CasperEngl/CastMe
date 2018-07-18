@extends('master')
@section('content')
  <main class="container">
    <div class="row">

      <?php
      
      for ($i = 0; $i < 8; $i++) {
        ?>
        <div class="col-md-4">
          <article class="card post-card">
            <figure class="card-img-top">
              <img src="{{ asset('img/placeholder-wallpaper.jpg') }}" alt="">
            </figure>
            <section class="card-body">
              <h4 class="card-title">{{ title_case('Post Title') }}</h4>
              <h6 class="card-subtitle mb-2 text-muted">Written by John Doe</h6>
              <p class="card-text">{{ str_limit(Lipsum::short()->text(3), 150, '...') }}</p>
              <a href="/contact/123" class="card-link font-weight-bold">Contact Scout</a>
              <a href="/post/1123" class="card-link">Read more</a>
            </section>
          </article>
        </div>
        <?php
      }

      ?>

    </div>
  </main>
@endsection