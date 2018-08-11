@extends('layouts.master')
@section('content')
  <main class="container">
    <h2 class="page-header">{{ title_case($title) }}</h2>

    <form action="{{ $form_url }}">

      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-auto">
              <span class="h3">{{ title_case(__('Title')) }}</span>
            </div>
            <div class="col">
              <input type="text" name="title" class="form-control bg-transparent" value="{{ $post->title }}">
            </div>
          </div>
        </div>
        <div class="card-block">
          <div class="form-group">
            <h5 class="text-muted">{{ title_case(__('Looking for')) }}</h5>
            <p>{{ __('Select multiple if applicable') }}</p>
            <ul class="pagination">
              <div class="display-none">
                <input type="checkbox" name="actor" value="1" id="profile_type-actor">
                <input type="checkbox" name="dancer" value="1" id="profile_type-dancer">
                <input type="checkbox" name="entertainer" value="1" id="profile_type-entertainer">
                <input type="checkbox" name="event_staff" value="1" id="profile_type-event_staff">
                <input type="checkbox" name="extra" value="1" id="profile_type-extra">
                <input type="checkbox" name="model" value="1" id="profile_type-model">
                <input type="checkbox" name="musician" value="1" id="profile_type-musician">
              </div>
              <li class="page-item">
                <label for="profile_type-actor" class="page-link" href="#">{{ title_case(__('Actor')) }}</label>
              </li>
              <li class="page-item">
                <label for="profile_type-dancer" class="page-link" href="#">{{ title_case(__('Dancer')) }}</label>
              </li>
              <li class="page-item">
                <label for="profile_type-entertainer" class="page-link" href="#">{{ title_case(__('Entertainer')) }}</label>
              </li>
              <li class="page-item">
                <label for="profile_type-event_staff" class="page-link" href="#">{{ title_case(__('Event staff')) }}</label>
              </li>
              <li class="page-item">
                <label for="profile_type-extra" class="page-link" href="#">{{ title_case(__('Extra')) }}</label>
              </li>
              <li class="page-item">
                <label for="profile_type-model" class="page-link" href="#">{{ title_case(__('Model')) }}</label>
              </li>
              <li class="page-item">
                <label for="profile_type-musician" class="page-link" href="#">{{ title_case(__('Musician')) }}</label>
              </li>
            </ul>
          </div>
        </div>
        <div class="card-block">
          <div id="ImageInputs"></div>
        </div>
        {{-- 
        <div class="card-block">

          <div class="row mb-2">
            <div class="col-auto d-flex align-items-center">
              <h5 class="text-muted m-0">{{ title_case(__('Images')) }}</h5>
            </div>
            <div class="col">
              <a href="#" class="btn btn-primary circle duplicate-input-group-button"><i class="fas fa-plus"></i></a>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col">
                <input type="url" name="image[]" placeholder="https://i.imgur.com/XXxXxxX.png" class="form-control text-muted" id="image-1">
                <div class="valid-feedback feedback-icon">
                  <i class="fa fa-check"></i>
               </div>
               <div class="invalid-feedback feedback-icon">
                  <i class="fa fa-times"></i>
               </div>
              </div>
              <div class="col-auto">
                <a href="#" class="btn btn-primary circle remove-input-group-button"><i class="fas fa-minus"></i></a>
              </div>
            </div>
          </div>

        </div>
        --}}
        <div class="card-block">
          <textarea name="message" class="tinymce">{{ $post->content }}</textarea>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">{{ title_case($type) }}</button>
        </div>
      </div>

      @csrf
      @method('post')
    </form>

  </main>
@endsection