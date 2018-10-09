@extends('layouts.static')

@section('content')
<div class="container">
  <div class="row">
    <div class="col">
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
          <h2 class="page-header">{{ ucfirst(__('posts')) }} <i class="fas fa-clipboard-list"></i></h2>
          <div class="row">
      
          @if (count($posts))
            @foreach($posts as $post)
            <a href="{{ route('post', ['id' => $post->id]) }}" class="post-card__link col-sm-6 animated fadeInRight">
              <article class="post-card post-card--sm">
                <figure class="post-card__frame">
                  <img src="{{ Storage::disk('public')->url($post->banner) }}" alt="{{ strip_tags($post->location) }}" class="post-card__frame__img">
                  <div class="post-card__roles">
                    @foreach (json_decode($post->roles) as $key => $role)
                    <span class="badge badge-pill badge-castme py-2 px-3 my-1 mr-1">{{ strtoupper(__($role)) }}</span>
                    @endforeach
                  </div>
                </figure>
                <div class="post-card__info">
                  @if (Auth::user() && Auth::id() === $post->user_id)
                  <p class="post-card__author">{{ ucfirst(__('written by')) }} {{ strtoupper(__('you')) }}</p>
                  @else
                  <p class="post-card__author">{{ ucfirst(__('written by')) }} {{ $post->owner->name }}</p>
                  @endif
                  <h2 class="post-card__title">{{ str_limit(title_case($post->title), 40) }}</h2>
                </div>
              </article>
            </a>
            @endforeach
          @endif
      
          <div class="col-12 d-flex justify-content-center mt-4">
            <a href="{{ route('posts') }}" class="btn btn-lg btn-castme">Se flere</a>
          </div>
      
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
    </div>
    <aside class="col-sm-3 d-none d-lg-block" style="position: relative;">
      <div class="sidebar" id="sidebar" data-toggle="affix">
        <section class="list-group card">
          <article class="card-block">
            <p class="text-center">Find os på Facebook og Instagram</p>
            <div class="d-flex">
              <a href="#" class="mr-2">
                <img src="/img/insta.png" alt="instagram logo">
              </a>
              <a href="#">
                <img src="/img/facebook.png" alt="facebook logo">
              </a>
            </div>
          </article>
        </section>
        <section class="list-group my-4 py-2 card d-flex align-items-center">
          <p class="h4 text-align">Nyeste bruger</p>
          @foreach ($latestUsers as $user)
          <figure class="circle sidebar__user__avatar">
            <img src="{{ Storage::disk('public')->url($user->avatar) }}" alt="">
          </figure>
          <p class="sidebar__user__name">{{ $user->name }}</p>
          @endforeach
          <hr class="w-100">
          <p class="h4 text-align">Fremhævet profil</p>
          @foreach ($showcasedUsers as $user)
          <figure class="circle sidebar__user__avatar">
            <img src="{{ Storage::disk('public')->url($user->avatar) }}" alt="">
          </figure>
          <p class="sidebar__user__name">{{ $user->name }}</p>
          @endforeach
        </section>
      </div>
    </aside>
  </div>
</div>
@endsection
