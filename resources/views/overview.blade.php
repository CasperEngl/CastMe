@extends('master')
@section('content')
  <main class="container">
    <h2 class="page-header">{{ title_case(__('Options')) }}</h2>
    <div class="row">
      <div class="col-12 col-sm-6 col-md-3">
        <a href="/subscription" class="btn btn-primary tile">
          <i class="fas fa-grin"></i> {{ title_case(__('My subscription')) }}
        </a>
      </div>
      <div class="col-12 col-sm-6 col-md-3">
        <a href="/profile" class="btn btn-primary tile">
          <i class="fas fa-user"></i> {{ title_case(__('My profile')) }}
        </a>
      </div>
      <div class="col-12 col-sm-6 col-md-3">
        <a href="/posts" class="btn btn-primary tile">
          <i class="fas fa-bookmark"></i> {{ title_case(__('Posts')) }}
        </a>
      </div>
    </div>
    {{--Admin only--}}
    @if(in_array(Auth::user()->role, ['Scout', 'Moderator', 'Admin']))
      <h2 class="page-header">{{ title_case(__('Admin')) }}</h2>
      <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
          <a href="#" class="btn btn-primary tile">
            <i class="fas fa-users"></i> {{ title_case(__('Users')) }}
          </a>
        </div>
      </div>
    @endif
  </main>
@endsection
