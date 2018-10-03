@extends('layouts.master')
@section('content')    
<div class="card p-5">
  <div class="row">
    <div class="col-sm-6 d-flex flex-column justify-content-center align-items-center">
      @if ($avatar)
      <figure class="circle avatar">
        <img src="{{ $avatar }}" alt="{{ __('avatar') }}">
      </figure>
      @endif
      <div class="card-title m-0">{{ $user->name }} {{ $user->last_name }}</div>
      @if (isset($profile_types) && count($profile_types) > 0)
      <div class="card-text text-muted">{{ count($profile_types) > 1 ? ucfirst(__('roles')) : ucfirst(__('role')) }}</div>
      <div class="card-text text-muted">
        @foreach ($profile_types as $profile_type)
          {{ $profile_type }}
          @if (!$loop->last)
          &mdash;
          @endif
        @endforeach
      </div>
      @endif
      @if (Auth::user() && Auth::id() === $user->id)
      <form action="{{ route('conversation.new') }}" method="post">
        @csrf
        <input type="hidden" name="users[]" value="{{ Auth::id() }}">
        <input type="hidden" name="users[]" value="{{ $user->id }}">
        <input type="submit" class="btn btn-castme mt-2" value="{{ ucfirst(__('message')) }}">
      </form>
      @endif
    </div>
    <div class="col-sm-6">
      <section class="row">
        <div class="col-12">
          <h4 class="profile__title">{{ ucfirst(__('description')) }}</h4>
        </div>
        <div class="col-12">
          @if ($user->details->description)
          <p>{{ $user->details->description }}</p>
          @else
          <p>{{ ucfirst(__('user has no description.')) }}</p>
          @endif
        </div>
      </section>

      <section class="row">
        <div class="col-12">
          <h4 class="profile__title">{{ ucfirst(__('Details')) }}</h4>
        </div>
        <div class="col-12">
          @if ($user->details->ethnicity)
          <p class="text-muted m-0">{{ ucfirst(__('ethnicity')) }}</p>
          <p class="h5">{{ $user->details->ethnicity }}</p>
          @endif
          @if ($user->details->eye_color)
          <p class="text-muted m-0">{{ ucfirst(__('eye color')) }}</p>
          <p class="h5">{{ $user->details->eye_color }}</p>
          @endif
          @if ($user->details->hair_length)
          <p class="text-muted m-0">{{ ucfirst(__('hair length')) }}</p>
          <p class="h5">{{ $user->details->hair_length }}</p>
          @endif
          @if ($user->details->hair_color)
          <p class="text-muted m-0">{{ ucfirst(__('hair color')) }}</p>
          <p class="h5">{{ $user->details->hair_color }}</p>
          @endif
          @if ($user->details->age)
          <p class="text-muted m-0">{{ ucfirst(__('age')) }}</p>
          <p class="h5">{{ $user->details->age }}</p>
          @endif
          @if ($user->details->height)
          <p class="text-muted m-0">{{ ucfirst(__('height')) }}</p>
          <p class="h5">{{ $user->details->height }}</p>
          @endif
          @if ($user->details->weight)
          <p class="text-muted m-0">{{ ucfirst(__('weight')) }}</p>
          <p class="h5">{{ $user->details->weight }}</p>
          @endif
          @if ($user->details->experience)
          <p class="text-muted m-0">{{ ucfirst(__('experience')) }}</p>
          <p class="h5">{{ $user->details->experience }}</p>
          @endif
          @if ($user->details->pant_size)
          <p class="text-muted m-0">{{ ucfirst(__('pants size')) }}</p>
          <p class="h5">{{ $user->details->pant_size }}</p>
          @endif
          @if ($user->details->shoe_size)
          <p class="text-muted m-0">{{ ucfirst(__('shoe size')) }}</p>
          <p class="h5">{{ $user->details->shoe_size }}</p>
          @endif
          @if ($user->details->shirt_size)
          <p class="text-muted m-0">{{ ucfirst(__('shirt size')) }}</p>
          <p class="h5">{{ $user->details->shirt_size }}<p>
          @endif
        </div>
      </section>
    </div>
  </div>
</div>
@endsection