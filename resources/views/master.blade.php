<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>
      <?php echo $pageTitle?? "Cast Me"; ?>
  </title>

  <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">

</head>

<body>

<header>
  <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="/">
        <img src="{{ asset('img/logo.png') }}" alt="castme logo">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
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
              <a href="#!" class="dropdown-item">{{ title_case(__('New post')) }}</a>
              <a href="#!" class="dropdown-item">{{ title_case(__('New message')) }}</a>
              <a href="/conversations" class="dropdown-item">{{ title_case(__('Conversations')) }} <span class="badge badge-danger">7</span></a>
            </div>
          </li>
        </ul>
      
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="/overview">{{ title_case(__('Overview')) }}</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/posts">{{ title_case(__('Posts')) }}</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/logout">{{ title_case(__('Logout')) }} <i class="fas fa-sign-out-alt"></i></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>

<div id="wrapper">
  @if ($errors->any())
    <div class="container">
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    </div>
  @endif
  
  @yield('content')
</div>

<script src="{{ asset('js/app.js') }}"></script>

</body>

</html>
