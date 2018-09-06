@extends('layouts.master')
@section('content')
<main class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      
      <div class="card">
        <div class="card-header d-flex align-items-center">
          @if ($avatar)
          <figure class="circle profile-avatar">
            <img src="{{ $avatar }}" alt="{{ __('avatar') }}">
          </figure>
          @endif
          <div class="d-flex flex-column ml-3">
            <div class="card-title m-0">{{ $user->name }} {{ $user->last_name }}</div>
            @if (count($profile_types) > 0)
            <div class="card-text text-muted">{{ count($profile_types) > 1 ? ucfirst(__('roles')) : ucfirst(__('role')) }}</div>
            <div class="card-text text-muted">
              @foreach ($profile_types as $profile_type)
              {{ $profile_type }} @if (!$loop->last) &mdash; @endif
              @endforeach
            </div>
            @endif
          </div>
        </div>
        <div class="card-body">
          <h2 class="page-header">{{ title_case(__('profile description')) }}</h2>
          @if ($user->details->description)
          <p class="profile-description">{{ $user->details->description }}</p>
          @else
          <p class="profile-description">{{ ucfirst(__('user has no description.')) }}</p>
          @endif
          
          @if ($user->details->ethnicity || $user->details->eye_color || $user->details->hair_length || $user->details->hair_color)
          <hr>
          @endif

          <div class="row">
            @if ($user->details->ethnicity)
            <div class="col-xs-6 col-sm-4 col-md-3 mt-2 mb-2">
              <h3 class="text-muted">{{ title_case(__('ethnicity')) }}</h3>
              <h4>{{ $user->details->ethnicity }}</h4>
            </div>
            @endif
            @if ($user->details->eye_color)
            <div class="col-xs-6 col-sm-4 col-md-3 mt-2 mb-2">
              <h3 class="text-muted">{{ title_case(__('eye color')) }}</h3>
              <h4>{{ $user->details->eye_color }}</h4>
            </div>
            @endif
            @if ($user->details->hair_length)
            <div class="col-xs-6 col-sm-4 col-md-3 mt-2 mb-2">
              <h3 class="text-muted">{{ title_case(__('hair length')) }}</h3>
              <h4>{{ $user->details->hair_length }}</h4>
            </div>
            @endif
            @if ($user->details->hair_color)
            <div class="col-xs-6 col-sm-4 col-md-3 mt-2 mb-2">
              <h3 class="text-muted">{{ title_case(__('hair color')) }}</h3>
              <h4>{{ $user->details->hair_color }}</h4>
            </div>
            @endif
          </div>

          @if ($user->details->ethnicity || $user->details->eye_color || $user->details->hair_length || $user->details->hair_color)
          <hr>
          @endif

          <div class="row">
            @if ($user->details->age)
            <div class="col-xs-6 col-sm-4 col-md-3 mt-2 mb-2">
              <h3 class="text-muted">{{ title_case(__('age')) }}</h3>
              <h4>{{ $user->details->age }}</h4>
            </div>
            @endif
            @if ($user->details->height)
            <div class="col-xs-6 col-sm-4 col-md-3 mt-2 mb-2">
              <h3 class="text-muted">{{ title_case(__('height')) }}</h3>
              <h4>{{ $user->details->height }}</h4>
            </div>
            @endif
            @if ($user->details->weight)
            <div class="col-xs-6 col-sm-4 col-md-3 mt-2 mb-2">
              <h3 class="text-muted">{{ title_case(__('weight')) }}</h3>
              <h4>{{ $user->details->weight }}</h4>
            </div>
            @endif
            @if ($user->details->experience)
            <div class="col-xs-6 col-sm-4 col-md-3 mt-2 mb-2">
              <h3 class="text-muted">{{ title_case(__('experience')) }}</h3>
              <h4>{{ $user->details->experience }}</h4>
            </div>
            @endif
            @if ($user->details->pant_size)
            <div class="col-xs-6 col-sm-4 col-md-3 mt-2 mb-2">
              <h3 class="text-muted">{{ title_case(__('pants size')) }}</h3>
              <h4>{{ $user->details->pant_size }}</h4>
            </div>
            @endif
            @if ($user->details->shoe_size)
            <div class="col-xs-6 col-sm-4 col-md-3 mt-2 mb-2">
              <h3 class="text-muted">{{ title_case(__('shoe size')) }}</h3>
              <h4>{{ $user->details->shoe_size }}</h4>
            </div>
            @endif
            @if ($user->details->shirt_size)
            <div class="col-xs-6 col-sm-4 col-md-3 mt-2 mb-2">
              <h3 class="text-muted">{{ title_case(__('shirt size')) }}</h3>
              <h4>{{ $user->details->shirt_size }}<h4>
            </div>
            @endif
          </div>
        </div>
        <div class="card-footer">
          <a href="/conversations/new/{{ $user->id }}" class="card-link btn btn-primary">{{ title_case(__('message')) }}</a>
          <a href="/poke/{{ $user->id }}" class="card-link">{{ title_case(__('poke')) }}</a>
        </div>
      </div>

    </div>
  </div>
</main>
@endsection