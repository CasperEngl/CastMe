<?php

use App\ProfileRole;

?>

@extends('layouts.master')
@section('content')

<form action="{{ route('profiles.search') }}">
  <div class="row mb-3">
    <div class="col d-flex">
      <div class="btn-group mr-3">
        <button type="button" class="btn btn-castme dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          {{ ucfirst(__('roles')) }}
        </button>
        <div class="dropdown-menu">
          @foreach (ProfileRole::getPossibleRoles() as $role)
          <a class="dropdown-item" href="{{ route('profiles.search', ['q' => $role]) }}">
            {{ ucfirst(__(str_replace('_', ' ', $role))) }}
          </a>
          @endforeach
        </div>
      </div>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text" id="profile-filter">{{ ucfirst(__('search')) }}</span>
        </div>
        <input type="text" class="form-control bootstrap" placeholder="{{ sentence(__('search by title, content, roles or users')) }}" name="q" aria-label="Search" aria-describedby="profile-filter">
      </div>
    </div>
    <div class="col-auto pl-0">
      <button class="btn btn-castme">Search</button>
    </div>
  </div>
</form>
{{-- Check if no profiles or all profiles are closed --}}
@if (!count($profiles))
  <div class="page-header">{{ ucfirst(__('no profiles')) }}</div>
@else
  <div class="page-header">{{ $title }}</div>
  <div class="row">
    @foreach($profiles as $key => $profile)
    <a href="{{ route('profile', ['id' => $profile->id]) }}" class="profile-card__link col-12 col-md-6 animated fadeInRight delay-{{ $key * 100 }}ms">
      <article class="profile-card">
        <figure class="profile-card__frame">
          <img src="{{ Storage::disk('public')->url($profile->avatar) }}" alt="{{ strip_tags($profile->description) }}" class="profile-card__frame__img">
          <div class="profile-card__roles">
            @foreach ($profile->profileRoles->toArray() as $key => $profileRole)
            @if ($key === 5)
              <span class="badge badge-pill badge-castme py-2 px-3 my-1 mr-1">...</span>
              @break
            @endif
            <span class="badge badge-pill badge-castme py-2 px-3 my-1 mr-1">{{ strtoupper(__($profileRole['role'])) }}</span>
            @endforeach
          </div>
        </figure>
        <div class="profile-card__info">
          <h2 class="profile-card__title">{{ str_limit(title_case($profile->name), 40) }}</h2>
        </div>
      </article>
    </a>
    @endforeach
  </div>
@endif

@endsection