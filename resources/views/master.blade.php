<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>
      <?php echo $pageTitle?? "CastMe"; ?>
  </title>

  <link href="//fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/css/materialize.min.css">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/admin.css') }}">

</head>

<body>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/js/materialize.min.js"></script>
<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
<script src="{{ asset('js/admin.js') }}"></script>

<header class="secondHeader">
  <nav>
    <ul class="user hide-on-med-and-down">
      <li>
        <a href="/profile/id" class="dropdownUser">
          <i class="material-icons">person</i>
          <b>Name</b>
          <span>| Role</span>
        </a>
      </li>
    </ul>

    <ul class="right no-hover">

      <li>
        <a href="#!" class="circle-btn waves-effect waves-light noti-drop" data-drop="#notification">
          <i class="material-icons">notifications</i>
          <span class="icon badge">2</span>
        </a>

        <ul id="notification" class="dropdown-content lined">
          <li class="header">Notifikationer</li>
          <ul class="notify">
            <li>
              <a href="#!" class="no-padding">
                <i class="material-icons green lighten-1">event</i> New Event
              </a>
            </li>
            <li>
              <a href="#!" class="no-padding">
                <i class="material-icons blue lighten-1">person_add</i> New Teamplayer
              </a>
            </li>
            <li>
              <a href="#!" class="no-padding">
                <i class="material-icons red lighten-1">email</i> You've got mail
              </a>
            </li>
          </ul>
          <li class="footer"><a href="#">vis flere</a></li>
        </ul>
      </li>
      <li><a href="/settings" class="circle-btn waves-effect waves-light"><i class="material-icons">settings</i></a>
      </li>
      <li><a href="/overview" class="circle-btn waves-effect waves-light"><i class="material-icons">view_comfy</i></a>
      </li>
      <li><a href="/_admin/templates/parts/logout.php" class="circle-btn waves-effect waves-light"><i
            class="material-icons">exit_to_app</i></a></li>
    </ul>
  </nav>
</header>

<ul id="slide-out" class="side-nav fixed" field="searchSort">
  <li class="logo">
    <a href="/overview">
      <img src="/_admin/assets/img/users/avatar" alt="Username"> username

    </a>
  </li>
  <li class="row profile-tile hide-on-large-only">
    <a href="/profile/user_id" class="waves-effect waves-light">
      <div class="col s2 no-padding">
        <img class="circle" src="/_admin/assets/img/users/
avatar">
      </div>
      <div class="info col s10">
          user->name
        <span>Se profil</span>
      </div>
    </a>
  </li>
  <li class="search">

    <div class="input-field col s12 no-padding">
      <input id="searchText" field="search" type="search" required>
      <label for="search"><i class="material-icons">search</i></label>
    </div>

  </li>
  <div class="row sort">

         <li>
         <a href="/link" class="waves-effect waves-light">
         <div class="col s2 no-padding">
         <i class="material-icons">face</i>
         </div>
         <div class="col s10">
          Menu title
         </div>
         </a>
         </li>
  </div>
</ul>

<div id="wrapper">
  @yield('content')
</div>
</body>

</html>
