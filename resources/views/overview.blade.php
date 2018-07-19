@extends('master')
@section('content')
  <main class="container">
    <h2 class="page-header">Options</h2>
    <div class="row">
      <div class="col-12 col-sm-6 col-md-3">
        <a href="/Subscription" class="btn btn-primary tile">
          <i class="fas fa-grin"></i> My subscription
        </a>
      </div>
      <div class="col-12 col-sm-6 col-md-3">
        <a href="/profile" class="btn btn-primary tile">
          <i class="fas fa-user"></i> My profile
        </a>
      </div>
      <div class="col-12 col-sm-6 col-md-3">
        <a href="/posts" class="btn btn-primary tile">
          <i class="fas fa-bookmark"></i> Posts
        </a>
      </div>
    </div>
    {{--Admin only--}}
    @if(in_array(Auth::user()->role, ['Scout', 'Moderator', 'Admin']))
      <h2 class="page-header">Admin</h2>
      <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
          <a href="#" class="btn btn-primary tile">
            <i class="fas fa-users"></i> Users
          </a>
        </div>
      </div>
    @endif
  </main>
@endsection
