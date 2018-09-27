@extends('layouts.master')

@section('content')
<section class="hero jumbotron">
  <div class="container d-flex flex-column align-items-center">
    <h1 class="animated fadeIn">Er casting noget for dig?</h1>
    <a href="/register" class="btn btn-castme btn-lg m-4">{{ title_case(__('register')) }}</a>
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

    @if (empty(array_filter(json_decode($posts), function ($post) {
      return $post->closed === 0;
    })))
      @foreach($posts as $post)
        @if (!$post->closed || $own)
        <a href="{{ route('post', ['id' => $post->id]) }}" class="post-card__link col-12 animated fadeInRight">
          <article class="post-card post-card--sm">
            <figure class="post-card__frame">
              <img src="{{ Storage::disk('public')->url($post->banner) }}" alt="{{ strip_tags($post->content) }}" class="post-card__frame__img">
              <div class="post-card__roles">
                @foreach (json_decode($post->roles) as $key => $role)
                <span class="badge badge-pill badge-castme py-2 px-3 my-1 mr-1">{{ strtoupper(__($role)) }}</span>
                @endforeach
              </div>
            </figure>
            <div class="post-card__info">
              @if (Auth::user()->id === $post->user_id)
              <p class="post-card__author">{{ ucfirst(__('written by')) }} {{ strtoupper(__('you')) }}</p>
              @else
              <p class="post-card__author">{{ ucfirst(__('written by')) }} {{ $post->owner->name }}</p>
              @endif
              <h2 class="post-card__title">{{ str_limit(title_case($post->title), 40) }}</h2>
            </div>
          </article>
        </a>
        @endif
      @endforeach
    @endif

    </div>
  </div>
</section>

<footer class="footer p-5 bg-dark">
  <div class="container">
    <div class="row d-flex align-items-center">
      <div class="col">
        <h2 class="text-white">Find dit castingjob i dag!</h2>
        <a href="/register" class="text-center btn btn-castme">{{ title_case(__('register')) }}</a>
      </div>
      <div class="col-auto">
        <iframe src="https://support.wkt.dk/public/kort.php?cards=visa,mastercard-w,paypal-w" class="cards" frameborder="0" kwframeid="1" style="zoom: 1;"></iframe>
      </div>
    </div>
  </div>
</footer>
@endsection
