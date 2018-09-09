@extends('layouts.master')
@section('content')    
<div class="card">
  <div class="card-header d-flex align-items-center">
    @if ($avatar)
    <figure class="circle avatar">
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
    <h2 class="page-header w-100">{{ title_case(__('profile description')) }}</h2>
    @if ($user->details->description)
    <p class="profile-description w-100">{{ $user->details->description }}</p>
    @else
    <p class="profile-description w-100">{{ ucfirst(__('user has no description.')) }}</p>
    @endif
    
    @if ($user->details->ethnicity || $user->details->eye_color || $user->details->hair_length || $user->details->hair_color)
    <hr>
    @endif

    @if ($user->details->ethnicity)
    <p class="text-muted m-0">{{ title_case(__('ethnicity')) }}</p>
    <p class="h5">{{ $user->details->ethnicity }}</p>
    @endif
    @if ($user->details->eye_color)
    <p class="text-muted m-0">{{ title_case(__('eye color')) }}</p>
    <p class="h5">{{ $user->details->eye_color }}</p>
    @endif
    @if ($user->details->hair_length)
    <p class="text-muted m-0">{{ title_case(__('hair length')) }}</p>
    <p class="h5">{{ $user->details->hair_length }}</p>
    @endif
    @if ($user->details->hair_color)
    <p class="text-muted m-0">{{ title_case(__('hair color')) }}</p>
    <p class="h5">{{ $user->details->hair_color }}</p>
    @endif

    @if ($user->details->age)
    <p class="text-muted m-0">{{ title_case(__('age')) }}</p>
    <p class="h5">{{ $user->details->age }}</p>
    @endif
    @if ($user->details->height)
    <p class="text-muted m-0">{{ title_case(__('height')) }}</p>
    <p class="h5">{{ $user->details->height }}</p>
    @endif
    @if ($user->details->weight)
    <p class="text-muted m-0">{{ title_case(__('weight')) }}</p>
    <p class="h5">{{ $user->details->weight }}</p>
    @endif
    @if ($user->details->experience)
    <p class="text-muted m-0">{{ title_case(__('experience')) }}</p>
    <p class="h5">{{ $user->details->experience }}</p>
    @endif
    @if ($user->details->pant_size)
    <p class="text-muted m-0">{{ title_case(__('pants size')) }}</p>
    <p class="h5">{{ $user->details->pant_size }}</p>
    @endif
    @if ($user->details->shoe_size)
    <p class="text-muted m-0">{{ title_case(__('shoe size')) }}</p>
    <p class="h5">{{ $user->details->shoe_size }}</p>
    @endif
    @if ($user->details->shirt_size)
    <p class="text-muted m-0">{{ title_case(__('shirt size')) }}</p>
    <p class="h5">{{ $user->details->shirt_size }}<p>
    @endif
  </div>
  <div class="card-footer">
    <a href="/conversations/new/{{ $user->id }}" class="card-link btn btn-primary">{{ title_case(__('message')) }}</a>
    <a href="/poke/{{ $user->id }}" class="card-link">{{ title_case(__('poke')) }}</a>
  </div>
</div>
@endsection