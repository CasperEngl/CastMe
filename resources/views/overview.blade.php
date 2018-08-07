@extends('master')
@section('content')
  <main class="container">
    <h2 class="page-header">{{ title_case(__('options')) }}</h2>
    <div class="row">
      <div class="col-12 col-sm-6 col-md-3">
        <a href="/subscription" class="btn btn-primary tile">
          <i class="fas fa-grin"></i> {{ title_case(__('subscription')) }}
        </a>
      </div>
      <div class="col-12 col-sm-6 col-md-3">
        <a href="/profile" class="btn btn-primary tile">
          <i class="fas fa-user"></i> {{ title_case(__('profile')) }}
        </a>
      </div>
      <div class="col-12 col-sm-6 col-md-3">
        <a href="/posts" class="btn btn-primary tile">
          <i class="fas fa-bookmark"></i> {{ title_case(__('posts')) }}
        </a>
      </div>
      <div class="col-12 col-sm-6 col-md-3">
        <a href="/conversations" class="btn btn-primary tile">
          <i class="fas fa-comments"></i> {{ title_case(__('conversations')) }}
        </a>
      </div>
    </div>
    {{--Scout only--}}
    @if(in_array(Auth::user()->role, ['Scout', 'Moderator', 'Admin']))
      <h2 class="page-header">{{ title_case(__('scout')) }}</h2>
      <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
          <a href="/post/new" class="btn btn-primary tile">
            <i class="fas fa-plus"></i> {{ title_case(__('add post')) }}
          </a>
        </div>
      </div>
    @endif
    {{--Admin only--}}
    @if(in_array(Auth::user()->role, ['Moderator', 'Admin']))
      <h2 class="page-header">{{ title_case(__('admin')) }}</h2>
      <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
          <a href="#" class="btn btn-primary tile">
            <i class="fas fa-users"></i> {{ title_case(__('users')) }}
          </a>
        </div>
      </div>
    @endif
  </main>
@endsection
