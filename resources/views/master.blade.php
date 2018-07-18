<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>
      <?php echo $pageTitle?? "Cast Me"; ?>
  </title>

  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">

</head>

<body>
<script src="http://unpkg.com/jquery/dist/jquery.min.js"></script>
<script src="https://tinymce.cachefly.net/4.1/tinymce.min.js"></script>
<script src="{{ asset('js/admin.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>

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
            <a href="/profile/id" class="nav-link">
              {{ Auth::User()->name }} | {{ Auth::User()->role }}
            </a>
          </li>
          <li class="nav-item dropdown">
            <a href="#!" class="nav-link dropdown-toggle" data-toggle="dropdown">
              <i class="material-icons">notifications</i>
              <span class="badge">2</span>
            </a>
            <div class="dropdown-menu">
              <a href="#!" class="dropdown-item">
                <i class="material-icons green lighten-1">local_offer</i> New Post
              </a>
              <a href="#!" class="dropdown-item">
                <i class="material-icons blue lighten-1">question_answer</i> New Message
              </a>
              <a href="#!" class="dropdown-item">
                <i class="material-icons red lighten-1">message</i> Messages <span class="badge">2</span>
              </a>
            </div>
          </li>
        </ul>
      
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="/overview">Overview</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/posts">Posts</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/logout">
              Logout <i class="material-icons">exit_to_app</i>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>

<div id="wrapper">
  @yield('content')
</div>
</body>

</html>
