@extends('layouts.master')
@section('content')
<section class="row">
  <div class="col-12">
    <h2 class="page-header">{{ title_case(__('options')) }}</h2>
  </div>
  <div class="col-12 col-sm-6 col-lg-4 animated fadeInRight delay-100ms">
    <a href="{{ route('user.subscription') }}" class="btn tile">
      <i class="fas fa-grin"></i><span class="d-inline-block">{{ title_case(__('subscription')) }}</span>
    </a>
  </div>
  <div class="col-12 col-sm-6 col-lg-4 animated fadeInRight delay-200ms">
    <a href="{{ route('user.settings') }}" class="btn tile">
      <i class="fas fa-user"></i><span class="d-inline-block">{{ title_case(__('profile settings')) }}</span>
    </a>
  </div>
  <div class="col-12 col-sm-6 col-lg-4 animated fadeInRight delay-300ms">
    <a href="{{ route('posts') }}" class="btn tile">
      <i class="fas fa-bookmark"></i><span class="d-inline-block">{{ title_case(__('posts')) }}</span>
    </a>
  </div>

  @paid
  <div class="col-12 col-sm-6 col-lg-4 animated fadeInRight delay-400ms">
    <a href="{{ route('conversations') }}" class="btn tile">
      <i class="fas fa-comments"></i><span class="d-inline-block">{{ title_case(__('conversations')) }}</span>
    </a>
  </div>
  @endpaid

  @scout
  <div class="col-12 col-sm-6 col-lg-4 animated fadeInRight delay-500ms">
    <a href="{{ route('post.new') }}" class="btn tile">
      <i class="fas fa-plus"></i><span class="d-inline-block">{{ title_case(__('new post')) }}</span>
    </a>
  </div>
  <div class="col-12 col-sm-6 col-lg-4 animated fadeInRight delay-600ms">
    <a href="{{ route('posts.own') }}" class="btn tile">
      <i class="fas fa-clipboard-list"></i><span class="d-inline-block">{{ title_case(__('your posts')) }}</span>
    </a>
  </div>
  @endscout
</section>

@admin
<section class="row">
  <div class="col-12">
    <h2 class="page-header">{{ title_case(__('admin')) }}</h2>
  </div>
  <div class="col-12 col-sm-6 col-lg-4 animated fadeInRight delay-700ms">
    <a href="#" class="btn tile">
      <i class="fas fa-users"></i><span class="d-inline-block">{{ title_case(__('users')) }}</span>
    </a>
  </div>
</section>
@endadmin
@endsection
