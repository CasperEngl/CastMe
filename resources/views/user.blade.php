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
          <h2 class="text-muted">{{ title_case(__('Profile description')) }}</h2>
          <p class="profile-description">{{ $user->details->description }}</p>

          <hr>

          <div class="row">
            <div class="col-xs-6 col-sm-4 col-md-3 mt-2 mb-2">
              <h3 class="text-muted">{{ title_case(__('Ethnicity')) }}</h3>
              <h4>{{ $user->details->ethnicity }}</h4>
            </div>
            <div class="col-xs-6 col-sm-4 col-md-3 mt-2 mb-2">
              <h3 class="text-muted">{{ title_case(__('Eye color')) }}</h3>
              <h4>{{ $user->details->eye_color }}</h4>
            </div>
            <div class="col-xs-6 col-sm-4 col-md-3 mt-2 mb-2">
              <h3 class="text-muted">{{ title_case(__('Hair length')) }}</h3>
              <h4>{{ $user->details->hair_length }}</h4>
            </div>
            <div class="col-xs-6 col-sm-4 col-md-3 mt-2 mb-2">
              <h3 class="text-muted">{{ title_case(__('Hair color')) }}</h3>
              <h4>{{ $user->details->hair_color }}</h4>
            </div>
          </div>

          <hr>

          <div class="row">
            <div class="col-xs-6 col-sm-4 col-md-3 mt-2 mb-2">
              <h3 class="text-muted">{{ title_case(__('Age')) }}</h3>
              <h4>{{ $user->details->age }}</h4>
            </div>
            <div class="col-xs-6 col-sm-4 col-md-3 mt-2 mb-2">
              <h3 class="text-muted">{{ title_case(__('Height')) }}</h3>
              <h4>{{ $user->details->height }}</h4>
            </div>
            <div class="col-xs-6 col-sm-4 col-md-3 mt-2 mb-2">
              <h3 class="text-muted">{{ title_case(__('Weight')) }}</h3>
              <h4>{{ $user->details->weight }}</h4>
            </div>
            <div class="col-xs-6 col-sm-4 col-md-3 mt-2 mb-2">
              <h3 class="text-muted">{{ title_case(__('Experience')) }}</h3>
              <h4>{{ $user->details->experience }}</h4>
            </div>
            <div class="col-xs-6 col-sm-4 col-md-3 mt-2 mb-2">
              <h3 class="text-muted">{{ title_case(__('Pants size')) }}</h3>
              <h4>{{ $user->details->pant_size }}</h4>
            </div>
            <div class="col-xs-6 col-sm-4 col-md-3 mt-2 mb-2">
              <h3 class="text-muted">{{ title_case(__('Shoe size')) }}</h3>
              <h4>{{ $user->details->shoe_size }}</h4>
            </div>
            <div class="col-xs-6 col-sm-4 col-md-3 mt-2 mb-2">
              <h3 class="text-muted">{{ title_case(__('Shirt size')) }}</h3>
              <h4>{{ $user->details->shirt_size }}<h4>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <a href="/conversations/new/{{ $user->id }}" class="card-link btn btn-primary">{{ title_case(__('Message')) }}</a>
          <a href="/poke/{{ $user->id }}" class="card-link">{{ title_case(__('Poke')) }}</a>
        </div>
      </div>

    </div>
  </div>
</main>
@endsection