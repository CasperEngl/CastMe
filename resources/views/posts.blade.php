@extends('master')
@section('content')
  <main class="container">
    <div class="row">

      <?php
      
      for ($i = 0; $i < 8; $i++) {
        $string = Lipsum::short()->html(3);

        ?>
        <div class="col-md-4">
          <article class="card post-card">
            <figure class="card-img-top">
              <img src="{{ asset('img/placeholder-wallpaper.jpg') }}" alt="">
            </figure>
            <section class="card-body">
              <h4 class="card-title">{{ title_case('Post Title') }}</h4>
              <h6 class="card-subtitle mb-2 text-muted">Written by John Doe</h6>
              <p class="card-text"><?php echo str_limit(strip_tags($string), 150, '...') ?></p>
              <a href="/message/{{ $i }}" class="card-link">Contact Scout</a>
              <a href="#!" class="card-link" data-toggle="modal" data-target="#post-{{ $i }}">Read more</a>
            </section>
          </article>

          <div class="modal" id="post-{{ $i }}">
            <div class="modal-dialog">
              <div class="modal-content">
          
                <!-- Modal Header -->
                <div class="modal-header">
                  <h4 class="modal-title">{{ title_case('Post Title') }}</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
          
                <div class="modal-body">
                  <h6 class="mb-2 text-muted">Written by John Doe</h6>
                  <?php echo $string ?>
                </div>
          
                <!-- Modal footer -->
                <div class="modal-footer">
                  <a href="/message/{{ $i }}" class="btn btn-primary">Contact Scout</a>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
          
              </div>
            </div>
          </div>
        </div>
        <?php
      }

      ?>

    </div>
  </main>
@endsection