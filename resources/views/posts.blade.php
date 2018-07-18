@extends('master')
@section('content')
  <main class="container">
    <div class="row">

      <?php
      
      for ($i = 0; $i < 5; $i++) {
        ?>
        <div class="col-md-4">
          <div class="card post-card">
            <figure class="card-img-top">
              <img src="{{ asset('img/placeholder-wallpaper.jpg') }}" alt="">
            </figure>
            <div class="card-body">
              <div class="card-gallery">
                <?php
                  
                for ($j = 0; $j < 3; $j++) {
                  ?>
                  <div class="card-gallery-image">
                    <img src="{{ asset('img/placeholder-wallpaper-2.jpg') }}" alt="">
                  </div>
                  <?php
                }

                ?>
              </div>
              <h5 class="card-title">{{ title_case('Card title') }}</h5>
              <h6 class="card-subtitle mb-2 text-muted">Written by John Doe</h6>
              <p class="card-text">{{ str_limit(str_random(50 * $i + 50), 50, ' (...)') }}</p>
              <a href="/contact/123" class="card-link">Contact Scout</a>
            </div>
          </div>
        </div>
        <?php
      }

      ?>

    </div>
  </main>
@endsection