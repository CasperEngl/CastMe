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
    <nav class="navbar navbar-expand-sm navbar-castme">
      <div class="container-fluid">
        <a class="navbar-brand" href="/">
          <img src="{{ asset('img/logo.png') }}" alt="castme logo">
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
            <form class="form mr-2 mb-0" action="{{ route('locale.set') }}" method="POST">
              <select name="locale" class="selectpicker" data-width="fit" data-style="btn-default">
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
                <div class="dropdown-header">{{ Auth::user()->name }} {{ Auth::user()->last_name }}</div>
                <a class="dropdown-item {{ active_route('user.settings', true) }}" href="{{ route('user.settings') }}">{{ ucfirst(__('profile settings')) }}</a>
                <a class="dropdown-item {{ active_route('user.subscription', true) }}" href="{{ route('user.subscription') }}">{{ ucfirst(__('subscription')) }}</a>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  {{ ucfirst(__('logout')) }} <i class="fas fa-sign-out-alt"></i></a>

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

  <main id="main">
    @yield('content')
  </main>

  <script src="{{ mix('js/app.js') }}"></script>

</body>