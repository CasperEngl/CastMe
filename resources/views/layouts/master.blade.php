<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name', 'Laravel') }}</title>

  <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
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
            <li class="nav-item">
              <a href="/profile/{{ Auth::User()->id }}" class="nav-link">
              {{ Auth::User()->name }} {{ Auth::User()->last_name }} | {{ Auth::User()->role }}
            </a>
            </li>
            <li class="nav-item dropdown">
              <a href="#!" class="nav-link dropdown-toggle" data-toggle="dropdown">
              <i class="fas fa-bell"></i>
              <span class="badge badge-danger">7</span>
            </a>
              <div class="dropdown-menu">
                <a href="#!" class="dropdown-item">{{ title_case(__('new post')) }}</a>
                <a href="#!" class="dropdown-item">{{ title_case(__('new message')) }}</a>
                <a href="/conversations" class="dropdown-item">{{ title_case(__('conversations')) }} <span class="badge badge-danger">7</span></a>
              </div>
            </li>
          </ul>

          <ul class="navbar-nav ml-auto">
            @guest
            <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">{{ title_case(__('login')) }}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('register') }}">{{ title_case(__('register')) }}</a>
            </li>
            @else
            <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false" v-pre>
              {{ Auth::user()->name }} <span class="caret"></span>
            </a>

              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('overview') }}">{{ title_case(__('overview')) }}</a>
                <a class="dropdown-item" href="{{ route('posts') }}">{{ title_case(__('posts')) }}</a>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                {{ title_case(__('logout')) }} <i class="fas fa-sign-out-alt"></i>
              </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </div>
            </li>
            @endguest
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

  <script src="{{ asset('js/app.js') }}"></script>

</body>
</html>