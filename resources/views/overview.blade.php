@extends('master')
@section('content')
  <main class="container">
    <div class="row doors">
      <span class="tile-title-grey" data-title="Kontrolpanel"></span>

      <div class="col s6 m3">
        <a href="/abonnement" class="white waves-effect waves-dark btn">
          <i class="material-icons">face</i> Mit Abonnement
        </a>
      </div>
    </div>
    {{--Paying only--}}
    <div class="row doors">
      <span class="tile-title-grey" data-title="Admin"></span>

      <div class="col s6 m3">
        <a href="Menu link" class="white waves-effect waves-dark btn">
          <i class="material-icons">person</i> Name
        </a>
      </div>
    </div>
  </main>
@endsection
