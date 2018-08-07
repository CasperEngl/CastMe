@extends('master')
@section('content')
<main class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      
      <div class="card">
        <div class="card-header">
          <div class="row align-items-center">
            <div class="col-2">
              <img src="https://www.gravatar.com/avatar/{{ $gravatar }}" alt="" class="rounded-circle">
            </div>
            <div class="col">
              <div class="card-title m-0">{{ $user->name }} {{ $user->last_name }}</div>
              <div class="card-text text-muted">{{ __('Roles') }}</div>
              <div class="card-text text-muted">
                @foreach ($profile_types as $profile_type)
                    {{ $profile_type }} @if (!$loop->last) &mdash; @endif
                @endforeach
              </div>
            </div>
          </div>
        </div>
        <div class="card-body">
          <h2 class="text-muted">{{ title_case(__('profile description')) }}</h2>
          <p class="profile-description">{{ $user->details->description }}</p>

          <hr>

          <div class="row">
            <div class="col-xs-6 col-sm-4 col-md-3 mt-2 mb-2">
              <h3 class="text-muted">{{ title_case(__('ethnicity')) }}</h3>
              <h4>{{ $user->details->ethnicity }}</h4>
            </div>
            <div class="col-xs-6 col-sm-4 col-md-3 mt-2 mb-2">
              <h3 class="text-muted">{{ title_case(__('eye color')) }}</h3>
              <h4>{{ $user->details->eye_color }}</h4>
            </div>
            <div class="col-xs-6 col-sm-4 col-md-3 mt-2 mb-2">
              <h3 class="text-muted">{{ title_case(__('hair length')) }}</h3>
              <h4>{{ $user->details->hair_length }}</h4>
            </div>
            <div class="col-xs-6 col-sm-4 col-md-3 mt-2 mb-2">
              <h3 class="text-muted">{{ title_case(__('hair color')) }}</h3>
              <h4>{{ $user->details->hair_color }}</h4>
            </div>
          </div>

          <hr>

          <div class="row">
            <div class="col-xs-6 col-sm-4 col-md-3 mt-2 mb-2">
              <h3 class="text-muted">{{ title_case(__('age')) }}</h3>
              <h4>{{ $user->details->age }}</h4>
            </div>
            <div class="col-xs-6 col-sm-4 col-md-3 mt-2 mb-2">
              <h3 class="text-muted">{{ title_case(__('height')) }}</h3>
              <h4>{{ $user->details->height }}</h4>
            </div>
            <div class="col-xs-6 col-sm-4 col-md-3 mt-2 mb-2">
              <h3 class="text-muted">{{ title_case(__('weight')) }}</h3>
              <h4>{{ $user->details->weight }}</h4>
            </div>
            <div class="col-xs-6 col-sm-4 col-md-3 mt-2 mb-2">
              <h3 class="text-muted">{{ title_case(__('experience')) }}</h3>
              <h4>{{ $user->details->experience }}</h4>
            </div>
            <div class="col-xs-6 col-sm-4 col-md-3 mt-2 mb-2">
              <h3 class="text-muted">{{ title_case(__('pants size')) }}</h3>
              <h4>{{ $user->details->pant_size }}</h4>
            </div>
            <div class="col-xs-6 col-sm-4 col-md-3 mt-2 mb-2">
              <h3 class="text-muted">{{ title_case(__('shoe size')) }}</h3>
              <h4>{{ $user->details->shoe_size }}</h4>
            </div>
            <div class="col-xs-6 col-sm-4 col-md-3 mt-2 mb-2">
              <h3 class="text-muted">{{ title_case(__('shirt size')) }}</h3>
              <h4>{{ $user->details->shirt_size }}<h4>
            </div>
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