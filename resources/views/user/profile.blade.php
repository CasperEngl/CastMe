@extends('layouts.master')
@section('content')    
<div class="card p-5">
  <div class="row">
    <div class="col-sm-6 my-4 d-flex flex-column justify-content-center align-items-center">
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

      <div id="userGallery" class="carousel slide mt-4" data-ride="carousel">
        <div class="carousel-inner">
          @foreach (Auth::user()->galleryImages as $key => $galleryImage)
          <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
            <img src="{{ Storage::disk('public')->url($galleryImage->image) }}" alt="{{ $user->name }} {{ $user->last_name }} gallery {{ $key + 1 }} image">
          </div>
          @endforeach
        </div>
        <a class="carousel-control-prev" href="#userGallery" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#userGallery" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>

      <ol class="carousel-indicators position-static mt-4">
        @foreach (Auth::user()->galleryImages as $key => $galleryImage)
        <li data-target="#userGallery" data-slide-to="{{ $key }}" {{ $key === 0 ? 'class="active"' : '' }}>
          <img src="{{ Storage::disk('public')->url($galleryImage->image) }}" alt="{{ $user->name }} {{ $user->last_name }} gallery image {{ $key + 1 }} thumbnail">
        </li>
        @endforeach
      </ol>
    </div>
    <div class="col-sm-6 my-4">
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
          <h4 class="profile__title">{{ ucfirst(__('details')) }}</h4>
        </div>
        <div class="col-12">
          <div class="row">
              @if ($user->details->ethnicity)
              <div class="col-12">
                <p class="text-muted m-0">{{ ucfirst(__('ethnicity')) }}</p>
                <p class="h4">{{ $user->details->ethnicity }}</p>
              </div>
              @endif
              @if ($user->details->eye_color)
              <div class="col-12">
                <p class="text-muted m-0">{{ ucfirst(__('eye color')) }}</p>
                <p class="h4">{{ $user->details->eye_color }}</p>
              </div>
              @endif
              @if ($user->details->hair_length)
              <div class="col-12">
                <p class="text-muted m-0">{{ ucfirst(__('hair length')) }}</p>
                <p class="h4">{{ $user->details->hair_length }}</p>
              </div>
              @endif
              @if ($user->details->hair_color)
              <div class="col-12">
                <p class="text-muted m-0">{{ ucfirst(__('hair color')) }}</p>
                <p class="h4">{{ $user->details->hair_color }}</p>
              </div>
              @endif
              @if ($user->details->age)
              <div class="col-12">
                <p class="text-muted m-0">{{ ucfirst(__('age')) }}</p>
                <p class="h4">{{ $user->details->age }}</p>
              </div>
              @endif
              @if ($user->details->height)
              <div class="col-12">
                <p class="text-muted m-0">{{ ucfirst(__('height')) }}</p>
                <p class="h4">{{ $user->details->height }}</p>
              </div>
              @endif
              @if ($user->details->weight)
              <div class="col-12">
                <p class="text-muted m-0">{{ ucfirst(__('weight')) }}</p>
                <p class="h4">{{ $user->details->weight }}</p>
              </div>
              @endif
              @if ($user->details->pant_size)
              <div class="col-12">
                <p class="text-muted m-0">{{ ucfirst(__('pants size')) }}</p>
                <p class="h4">{{ $user->details->pant_size }}</p>
              </div>
              @endif
              @if ($user->details->shoe_size)
              <div class="col-12">
                <p class="text-muted m-0">{{ ucfirst(__('shoe size')) }}</p>
                <p class="h4">{{ $user->details->shoe_size }}</p>
              </div>
              @endif
              @if ($user->details->shirt_size)
              <div class="col-12">
                <p class="text-muted m-0">{{ ucfirst(__('shirt size')) }}</p>
                <p class="h4">{{ $user->details->shirt_size }}<p>
              </div>
              @endif
          </div>
        </div>
      </section>
    </div>
  </div>
</div>
@endsection