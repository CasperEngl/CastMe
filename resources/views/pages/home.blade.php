@extends('layouts.master')

@section('content')
<div class="container">
  <div class="row">
    <div class="col content-wrapper">

    <div id="homepagecarousel" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#homepagecarousel" data-slide-to="0" class="active"></li>
        <li data-target="#homepagecarousel" data-slide-to="1"></li>
        <li data-target="#homepagecarousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <div class="slidercontent"> <h1>{{ sentence(__('Castme - connecting you')) }}</h1>
          @if (!Auth::check())
           <a href="/register" class="btn btn-castme btn-lg m-4">{{ title_case(__('register')) }}</a> 
        @else
        <a href="/posts" class="btn btn-castme btn-lg m-4">{{ title_case(__('se alle jobs her')) }}</a> </a>
        @endif
        </div>
          <img class="d-block w-100" src="img/castme1.jpg" alt="First slide">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="img/castme2.jpg" alt="Second slide">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="img/castme4.jpg" alt="Third slide">
        </div>
      </div>
      <a class="carousel-control-prev" href="#homepagecarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#homepagecarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>

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
      <section class="jumbotron mt-4 mb-0">
        <div class="container">
          <h2 class="page-header">{{ ucfirst(__('job posts')) }} <i class="fas fa-clipboard-list"></i></h2>
          <div class="row">
      
          @if (count($posts))
            @foreach($posts as $post)
            <a href="{{ route('post', ['id' => $post->id]) }}" class="post-card__link col-sm-6 animated fadeInRight">
              <article class="post-card post-card--sm">
                <figure class="post-card__frame">
                  <img src="{{ Storage::disk('public')->url($post->banner) }}" alt="{{ strip_tags($post->location) }}" class="post-card__frame__img">
                  <div class="post-card__roles">
                    @foreach ($post->postRoles->toArray() as $key => $postRole)
                    <span class="badge badge-pill badge-castme py-2 px-3 my-1 mr-1">{{ strtoupper(__($postRole['role'])) }}</span>
                    @endforeach
                  </div>
                </figure>
                <div class="post-card__info">
                  <h5 class="post-card__date">{{ Carbon::parse($post->created_at)->format('M j, Y \a\t G:i a') }}</h5>
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
            <a href="{{ route('posts') }}" class="btn btn-lg btn-castme">{{ title_case(__('view more')) }}</a>
          </div>
      
          </div>
        </div>
      </section>
    </div>
    <aside class="col-sm-3 d-none d-lg-block position-relative">
      <div class="sidebar" id="sidebar" data-toggle="affix">

        <section class="list-group mb-4 py-2 card d-flex align-items-center">
          <p class="h4 text-align">{{ sentence(__('newest user')) }}</p>
          @foreach ($latestUsers as $user)
          <figure class="sidebar__user__avatar">
            <img src="{{ Storage::disk('public')->url($user->avatar) }}" alt="">
          </figure>
          <p class="sidebar__user__name">{{ $user->name }}</p>
          @endforeach
          <hr class="w-100">
          <p class="h4 text-align">{{ sentence(__('highlighted profile')) }}</p>
          @foreach ($showcasedUsers as $user)
          <figure class="sidebar__user__avatar">
            <img src="{{ Storage::disk('public')->url($user->avatar) }}" alt="">
          </figure>
          <p class="sidebar__user__name">{{ $user->name }}</p>
          @endforeach
        </section>

        <section class="list-group card">
          <article class="card-block jcb">
            @if (!Auth::check())

          <article class="card-block">
            <p class="text-center h3 jh3">{{ sentence(__('create profile')) }}</p>
            <div class="d-flex">
              <a href="/register/" target="_blank" class="mr-2">
                <img src="/img/profile.png" alt="create profile">
              </a>
            </div>
          </article>

            <div class="card">
      <div class="card-body">
        <form action="{{ route('register') }}" method="POST" aria-label="{{ ucfirst(__('register')) }}">
          @csrf
          @method('POST')

          <div class="form-group row">
            <div class="col-md">
              <input id="name" type="text" placeholder="{{ sentence(__('name')) }}" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"  value="{{ old('name' ) }}" required autofocus>
              @if ($errors->has('name'))
              <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('name') }}</strong></span>
              @endif
            </div>
          </div>

          <div class="form-group row">
            <div class="col">
              <input id="last_name" type="text" placeholder="{{ sentence(__('last name')) }}" class="form-control {{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name') }}" required> @if ($errors->has('last_name'))
              <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('last_name') }}</strong></span> @endif
            </div>
          </div>

          <div class="form-group row">
            <div class="col">
              <input id="email" type="email" placeholder="{{ sentence(__('e-mail')) }}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
              @if ($errors->has('email'))
              <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('email') }}</strong></span>
              @endif
            </div>
          </div>

          <div class="form-group row">
            <div class="col">
              <input id="password" type="password" placeholder="{{ sentence(__('password')) }}" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required> 
              @if ($errors->has('password'))
              <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('password') }}</strong></span>
              @endif
            </div>
          </div>

          <div class="form-group row">
            <div class="col">
              <input id="password-confirm" type="password" placeholder="{{ sentence(__('confirm password')) }}" class="form-control" name="password_confirmation" required>
            </div>
          </div>

          <div class="form-group row mb-0">
            <div class="col">
              <button type="submit" class="text-center btn btn-castme fwb">{{ ucfirst(__('register')) }}</button>
            </div>
          </div>
        </form>
      </div>
          </article>
          
          </section>
        @else
            <a href="/overview" class="text-center btn btn-castme fwb">{{ sentence(__('go to my profile')) }}</a>
            @endif

             <section class="list-group my-4 py-2 card d-flex align-items-center">
          <article class="card-block">

            <p class="text-center h3 jh3">{{ sentence(__('become an agent')) }}</p>
            <div class="d-flex">
              <a href="#" target="_blank" class="mr-2">
                <img src="/img/agent.png" alt="create agent">
              </a>
            </div>

            <a href="/#" class="text-center btn btn-castme fwb">{{ sentence(__('become an agent')) }}</a>
          </article>
        </section>

 <section class="list-group my-4 py-2 card d-flex align-items-center">
          <p class="h4 text-align">{{ sentence(__('newest job post')) }}</p>
        </section>

      </div>
    </aside>
  </div>
</div>
@endsection
