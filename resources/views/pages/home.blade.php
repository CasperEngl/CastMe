@extends('layouts.master')

@section('content')
<section class="hero jumbotron">
  <div class="container d-flex flex-column align-items-center">
    <h1 class="animated fadeIn">Er casting noget for dig?</h1>
    <a href="/register" class="btn btn-primary btn-lg m-4">{{ title_case(__('register')) }}</a>
    <figure class="hero-image left animated fadeInUp">
      <img src="{{ asset('img/hero.jpg') }}" alt="">
    </figure>
    <figure class="hero-image right animated fadeInUp">
      <img src="{{ asset('img/hero.jpg') }}" alt="">
    </figure>
    <figure class="hero-image middle animated fadeInUp">
      <img src="{{ asset('img/hero.jpg') }}" alt="">
    </figure>
  </div>
</section>
<main>
  <section>
    <h2 class="text-center">Castme er lige nu under udvikling</h2>
    <p class="text-center">
      Castme er en platform hvor du kan finde blandt andet modeljobs, filmroller og statistjobs, men også opslag af mange andre arter i dit lokalområde.
    </p>
  </section>
  <section>
    <h2 class="text-center">Hvad kan du på din brugerprofil?</h2>
    <p class="text-center">
      Vores profilsystem leverer en sikker og brugervenlig platform til at holde øje med dine beskeder og dine opslag.
    </p>
    <div class="feature my-2 animated fadeInLeft delay-1000ms">
      <i class="fas fa-check-circle fa-2x text-info mr-2"></i> Chat imellem scouts og medlemmer
    </div>
    <div class="feature my-2 animated fadeInLeft delay-1500ms">
      <i class="fas fa-check-circle fa-2x text-info mr-2"></i> Notifikationer på opslag du er interreseret i
    </div>
    <div class="feature my-2 animated fadeInLeft delay-2000ms">
      <i class="fas fa-check-circle fa-2x text-info mr-2"></i> Abonnementsstyring, opgradering og nedgradering
    </div>
    <div class="feature my-2 animated fadeInLeft delay-2500ms">
      <i class="fas fa-check-circle fa-2x text-info mr-2"></i> Detaljeret profilredigering, billedeuskiftning og meget mere
    </div>
  </section>
</main>
<section class="jumbotron mt-4 mb-0">
  <div class="container">
    <h2 class="page-header">{{ ucfirst(__('posts')) }}</h2>
    <div class="row">

      @foreach($posts as $post)
      <div class="col-md-3">
        <article class="card h-100">
          <section class="card-body d-flex flex-wrap">
            <h4 class="card-title w-100">{{ title_case($post->title) }}</h4>
            @if (Auth::user() && Auth::id() === $post->user_id)
              <h6 class="card-subtitle w-100 mb-2 text-muted">{{ ucfirst(__('written by')) }} {{ strtoupper(__('you')) }}</h6>
            @else
              <h6 class="card-subtitle w-100 mb-2 text-muted">{{ ucfirst(__('written by')) }} {{ $post->owner->name }}</h6>
            @endif
            <p class="card-text w-100">{{ str_limit(strip_tags($post->content), 150, '...') }}</p>
          </section>
          <section class="card-footer d-flex flex-wrap align-items-center justify-content-center">
            <a href="{{ route('conversation', ['id' => $post->owner->id]) }}" class="card-link btn btn-link">{{ ucfirst(__('contact scout')) }}</a>
            <a href="/post/{{ $post->id }}" class="card-link btn btn-link">{{ ucfirst(__('read more')) }}</a>
            @if (Auth::user() && Auth::id() === $post->user_id)
            <a href="/post/{{ $post->id }}/edit" class="d-block w-100 mt-2 card-link btn btn-success">{{ ucfirst(__('edit')) }}</a>
            @endif
          </section>
        </article>
      </div>
      @endforeach

    </div>
  </div>
</section>

<footer class="footer p-5 bg-dark">
  <div class="container">
    <div class="row d-flex align-items-center">
      <div class="col">
        <h2 class="text-white">Find dit castingjob i dag!</h2>
        <a href="/register" class="text-center btn btn-primary">{{ title_case(__('register')) }}</a>
      </div>
      <div class="col-auto">
        <iframe src="https://support.wkt.dk/public/kort.php?cards=visa,mastercard-w,paypal-w" class="cards" frameborder="0" kwframeid="1" style="zoom: 1;"></iframe>
      </div>
    </div>
  </div>
</footer>
@endsection
