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

  <div id="wrapper" class="container">
    @if (Session::has('success'))
      @foreach (Session::get('success') as $success)
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ $success }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @admin
      <div class="snack snack-success">{{ $success }}</div>
      @endadmin
      @endforeach
    @endif 
    @if ($errors->any())
      @foreach ($errors->all() as $error)
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ $error }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @admin
      <div class="snack snack-danger">{{ $error }}</div>
      @endadmin
      @endforeach
    @endif

    <div class="row">
      @auth
      <aside class="col-sm-3 d-none d-lg-block">
        <div class="sidebar" id="sidebar" data-toggle="affix">
          <div class="list-group mb-4">
            <a href="{{ route('overview') }}" class="list-group-item {{ active_route('overview', true) }}">{{ title_case(__('overview')) }}</a>
            <a href="{{ route('posts') }}" class="list-group-item {{ active_routes(['posts', str_singular('posts')], true) }}">{{ title_case(__('posts')) }}</a>
          </div>
          <div class="list-group mb-4">
            <a href="{{ route('user.settings') }}" class="list-group-item {{ active_route('user.settings', true) }}">{{ title_case(__('profile settings')) }}</a>
            <a href="{{ route('user.subscription') }}" class="list-group-item {{ active_route('user.subscription', true) }}">{{ title_case(__('subscription')) }}</a>
          </div>
          @paid
          <div class="list-group mb-4">
            <a href="{{ route('conversations') }}" class="list-group-item {{ active_routes(['conversations', str_singular('conversations')], true) }}">{{ title_case(__('conversations')) }}</a>
          </div>
          @endpaid
          @scout
          <div class="list-group mb-4">
            <a href="{{ route('post.new') }}" class="list-group-item {{ active_route('post.new', true) }}">{{ title_case(__('new post')) }}</a>
            <a href="{{ route('posts.own') }}" class="list-group-item {{ active_route('posts.own', true) }}">{{ title_case(__('your posts')) }}</a>
          </div>
          @endscout
        </div>
      </aside>
      @endauth
      @guest
      <main id="main" class="col">
      @else
      <main id="main" class="col-lg-9">
      @endguest
        @yield('content')
      </main>
    </div>
  </div>

  @auth
  <?php
    $lang = Auth::user()->lang ?: 'en';
  ?>
  <script src="{{ asset('js/tm-editor-' . $lang . '.js') }}"></script>
  <script>
    @if (Auth::user()->lang)
    var locale = '{{ Auth::user()->lang }}';
    @endif
    var user = {{ Auth::id() }};
  </script>
  @endauth

  <script src="{{ mix('js/app.js') }}"></script>

</body>

</html>