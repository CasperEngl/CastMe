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
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="/">
        <img src="{{ asset('img/logo.png') }}" alt="castme logo">
      </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse"
          aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

        <div class="collapse navbar-collapse" id="navbar-collapse">
          <ul class="navbar-nav">
            @auth
            <li class="nav-item">
              <a href="/profile/{{ Auth::user()->id }}" class="nav-link">
              {{ Auth::user()->name }} {{ Auth::user()->last_name }} | {{ Auth::user()->role }}
            </a>
            </li>
            @endauth
            <li class="nav-item dropdown">
              <a href="#!" class="nav-link dropdown-toggle" data-toggle="dropdown">
              <i class="fas fa-bell"></i>
              <span class="badge badge-danger">7</span>
            </a>
              <div class="dropdown-menu">
                <a href="/conversations" class="dropdown-item">{{ title_case(__('conversations')) }} <span class="badge badge-danger">7</span></a>
              </div>
            </li>
          </ul>

          <ul class="navbar-nav align-items-center ml-auto">
            @guest
            <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">{{ title_case(__('login')) }}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('register') }}">{{ title_case(__('register')) }}</a>
            </li>
            @else
            <li class="nav-item">
              <a href="{{ route('overview') }}" class="nav-link">{{ title_case(__('overview')) }}</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('post.new') }}" class="nav-link">{{ title_case(__('new post')) }}</a>
            </li>
            <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false" v-pre>
              {{ Auth::user()->name }} <span class="caret"></span>
            </a>

              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('user.settings') }}">{{ title_case(__('profile settings')) }}</a>
                <a class="dropdown-item" href="{{ route('user.subscription') }}">{{ title_case(__('subscription')) }}</a>
                <a class="dropdown-item" href="{{ route('posts') }}">{{ title_case(__('posts')) }}</a>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                {{ title_case(__('logout')) }} <i class="fas fa-sign-out-alt"></i>
              </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                  @method('POST')
                </form>
              </div>
            </li>
            @endguest
            <form class="form" action="{{ route('locale.set') }}" method="POST">
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
          </ul>

        </div>
      </div>
    </nav>
  </header>

  <div id="wrapper">
    @if (Session::has('success'))
    <div class="container">
      @foreach (Session::get('success') as $success)
      <div class="alert alert-success">
        {{ $success }}
      </div>
      @endforeach
    </div>
    @endif @if ($errors->any())
    <div class="container">
      @foreach ($errors->all() as $error)
      <div class="alert alert-danger">
        {{ $error }}
      </div>
      @endforeach
    </div>
    @endif 
    
    @yield('content')
  </div>

  <script src="{{ mix('js/app.js') }}"></script>

</body>
</html>