<?php

use App\Helpers\RequestActive;

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name', 'Laravel') }}</title>

  <link rel="stylesheet" type="text/css" href="{{ mix('/css/app.css') }}">
</head>

<body>

  <header>
    <nav class="navbar navbar-expand-sm navbar-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="/">
        <img src="{{ asset('img/logo-dark.png') }}" alt="castme logo">
      </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse"
          aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

        <div class="collapse navbar-collapse" id="navbar-collapse">

          <ul class="navbar-nav align-items-center ml-auto">
            @guest
            <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">{{ title_case(__('login')) }}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('register') }}">{{ title_case(__('register')) }}</a>
            </li>
            @else
            <form class="form mr-2" action="{{ route('locale.set') }}" method="POST">
              <select name="locale" class="selectpicker" data-width="fit">
                <option value="en" data-content="<span class='flag-icon flag-icon-us'></span> {{ ucfirst(__('english')) }}" {{ Auth::user() && Auth::user()->lang === 'en' ? 'selected' : '' }}>
                  {{ ucfirst(__('english')) }}
                </option>
                <option value="da" data-content="<span class='flag-icon flag-icon-dk'></span> {{ ucfirst(__('danish')) }}" {{ Auth::user() && Auth::user()->lang === 'da' ? 'selected' : '' }}>
                  {{ ucfirst(__('danish')) }}
                </option>
              </select>
              
              @csrf
            </form>
            <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                @if (Storage::disk('public')->exists(Auth::user()->avatar))
                <figure class="circle header-avatar">
                  <img src="{{ Storage::disk('public')->url(Auth::user()->avatar) }}" alt="{{ __('avatar') }}">
                </figure>
                @else
                {{ Auth::user()->name }}
                @endif
              </a>

              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item {{ RequestActive::route('user.settings', true) }}" href="{{ route('user.settings') }}">{{ title_case(__('profile settings')) }}</a>
                <a class="dropdown-item {{ RequestActive::route('user.subscription', true) }}" href="{{ route('user.subscription') }}">{{ title_case(__('subscription')) }}</a>
                <a class="dropdown-item {{ RequestActive::route('conversations', true) }}" href="{{ route('conversations') }}" class="dropdown-item">{{ title_case(__('conversations')) }} <span class="badge badge-danger">7</span></a>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                {{ title_case(__('logout')) }} <i class="fas fa-sign-out-alt"></i></a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf @method('POST')
                </form>
              </div>
            </li>
            @endguest
          </ul>

        </div>
      </div>
    </nav>
  </header>

  <div id="wrapper" class="container">
    @if (Session::has('success'))
      @foreach (Session::get('success') as $success)
      <div class="alert alert-success">
        {{ $success }}
      </div>
      @endforeach
    @endif 
    @if ($errors->any())
      @foreach ($errors->all() as $error)
      <div class="alert alert-danger">
        {{ $error }}
      </div>
      @endforeach
    @endif

    <div class="row">
      <aside class="col-sm-3 d-none d-lg-block">
        <div class="sidebar" id="sidebar" data-toggle="affix">
          <div class="list-group mb-4">
            <li class="list-group-item {{ RequestActive::route('overview', true) }}">
              <a href="{{ route('overview') }}">{{ title_case(__('overview')) }}</a>
            </li>
            <li class="list-group-item {{ RequestActive::route('posts', true) }}">
              <a href="{{ route('posts') }}">{{ title_case(__('posts')) }}</a>
            </li>
            <li class="list-group-item {{ RequestActive::route('conversations', true) }}">
              <a href="{{ route('conversations') }}">{{ title_case(__('conversations')) }}</a>
            </li>
          </div>
          <div class="list-group mb-4">
            <li class="list-group-item {{ RequestActive::route('post.new', true) }}">
              <a href="{{ route('post.new') }}">{{ title_case(__('new post')) }}</a>
            </li>
          </div>
        </div>
      </aside>
      <main class="col">
        @yield('content')
      </main>
    </div>
  </div>

  <script src="{{ mix('js/app.js') }}"></script>

</body>

</html>