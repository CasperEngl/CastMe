@extends('layouts.master')
@section('content')
  <main class="container bg-white rounded px-5">
    <section class="row">
      <div class="col-12">
        <h2 class="page-header">{{ title_case(__('options')) }}</h2>
      </div>
      <div class="col-12 col-sm-6 col-lg-4">
        <a href="{{ route('user.subscription') }}" class="btn tile">
          <i class="fas fa-grin"></i><span class="d-inline-block">{{ title_case(__('subscription')) }}</span>
        </a>
      </div>
      <div class="col-12 col-sm-6 col-lg-4">
        <a href="{{ route('user.settings') }}" class="btn tile">
          <i class="fas fa-user"></i><span class="d-inline-block">{{ title_case(__('profile settings')) }}</span>
        </a>
      </div>
      <div class="col-12 col-sm-6 col-lg-4">
        <a href="{{ route('posts') }}" class="btn tile">
          <i class="fas fa-bookmark"></i><span class="d-inline-block">{{ title_case(__('posts')) }}</span>
        </a>
      </div>
      <div class="col-12 col-sm-6 col-lg-4">
        <a href="{{ route('conversations') }}" class="btn tile">
          <i class="fas fa-comments"></i><span class="d-inline-block">{{ title_case(__('conversations')) }}</span>
        </a>
      </div>
    </section>
    {{--Scout only--}}
    @if(in_array(Auth::user()->role, ['Scout', 'Moderator', 'Admin']))
    <section class="row">
      <div class="col-12">
        <h2 class="page-header">{{ title_case(__('scout')) }}</h2>
      </div>
      <div class="col-12 col-sm-6 col-lg-4">
        <a href="{{ route('post.new') }}" class="btn tile">
          <i class="fas fa-plus"></i><span class="d-inline-block">{{ title_case(__('new post')) }}</span>
        </a>
      </div>
    </section>
    @endif
    {{--Admin only--}}
    @if(in_array(Auth::user()->role, ['Moderator', 'Admin']))
    <section class="row">
      <div class="col-12">
        <h2 class="page-header">{{ title_case(__('admin')) }}</h2>
      </div>
      <div class="col-12 col-sm-6 col-lg-4">
        <a href="#" class="btn tile">
          <i class="fas fa-users"></i><span class="d-inline-block">{{ title_case(__('users')) }}</span>
        </a>
      </div>
    </section>
    @endif
  </main>
@endsection
