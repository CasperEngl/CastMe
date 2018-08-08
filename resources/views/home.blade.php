@extends('layouts.master')

@section('content')
<section class="hero jumbotron">
  <div class="container d-flex flex-column align-items-center">
    <h1 class="animated fadeIn">{{ ucfirst(__('is casting something for you?')) }}</h1>
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
<main class="container">
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
    <div class="feature d-flex align-items-center my-2 animated fadeInLeft delay-1000ms">
      <i class="fas fa-check-circle fa-2x text-info mr-2"></i> Chat imellem scouts og medlemmer
    </div>
    <div class="feature d-flex align-items-center my-2 animated fadeInLeft delay-1500ms">
      <i class="fas fa-check-circle fa-2x text-info mr-2"></i> Notifikationer på opslag du er interreseret i
    </div>
    <div class="feature d-flex align-items-center my-2 animated fadeInLeft delay-2000ms">
      <i class="fas fa-check-circle fa-2x text-info mr-2"></i> Abonnementsstyring, opgradering og nedgradering
    </div>
    <div class="feature d-flex align-items-center my-2 animated fadeInLeft delay-2500ms">
      <i class="fas fa-check-circle fa-2x text-info mr-2"></i> Detaljeret profilredigering, billedeuskiftning og meget mere
    </div>
  </section>
</main>
<section class="jumbotron mt-4 mb-0">
  <div class="container">
    <h2>Priser fra</h2>
    <div class="row">
      <div class="col-md-4">
        <div class="card">
          <div class="card-header">
            <h3>89 DKK/Måned</h3>
          </div>
          <div class="card-body">
            <ul>
              <li>Fuld opslagsoversigt</li>
              <li>Kontakt scouts direkte</li>
              <li>Sæt præferencer og foretrukkende</li>
            </ul>
          </div>
          <div class="card-footer">
            <a href="/register" class="card-link btn btn-primary">{{ title_case(__('register')) }}</a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-header">
            <h3>89 DKK/Måned</h3>
          </div>
          <div class="card-body">
            <ul>
              <li>Fuld opslagsoversigt</li>
              <li>Kontakt scouts direkte</li>
              <li>Sæt præferencer og foretrukkende</li>
            </ul>
          </div>
          <div class="card-footer">
            <a href="/register" class="card-link btn btn-primary">{{ title_case(__('register')) }}</a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-header">
            <h3>89 DKK/Måned</h3>
          </div>
          <div class="card-body">
            <ul>
              <li>Fuld opslagsoversigt</li>
              <li>Kontakt scouts direkte</li>
              <li>Sæt præferencer og foretrukkende</li>
            </ul>
          </div>
          <div class="card-footer">
            <a href="/register" class="card-link btn btn-primary">{{ title_case(__('register')) }}</a>
          </div>
        </div>
      </div>
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
