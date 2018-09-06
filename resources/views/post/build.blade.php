@extends('layouts.master')
@section('content')
<h2 class="page-header">{{ title_case($title) }}</h2>

<form action="{{ $form_url }}" method="POST">

  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col-auto">
          <span class="h3">{{ ucfirst(__('title')) }}</span>
        </div>
        <div class="col">
          <input type="text" name="title" class="form-control bg-transparent" value="{{ $post->title }}">
        </div>
      </div>
    </div>
    <div class="card-block">
      <div class="form-group">
        <h5 class="text-muted">{{ ucfirst(__('looking for')) }}</h5>
        <p>{{ ucfirst(__('select multiple if applicable')) }}</p>
        <ul class="pagination">
          <div class="display-none">
            <input type="checkbox" name="actor" value="1" id="profile_type-actor" {{ $post->actor ? 'checked' : '' }}>
            <input type="checkbox" name="dancer" value="1" id="profile_type-dancer" {{ $post->dancer ? 'checked' : '' }}>
            <input type="checkbox" name="entertainer" value="1" id="profile_type-entertainer" {{ $post->entertainer ? 'checked' : '' }}>
            <input type="checkbox" name="event_staff" value="1" id="profile_type-event_staff" {{ $post->event_staff ? 'checked' : '' }}>
            <input type="checkbox" name="extra" value="1" id="profile_type-extra" {{ $post->extra ? 'checked' : '' }}>
            <input type="checkbox" name="model" value="1" id="profile_type-model" {{ $post->model ? 'checked' : '' }}>
            <input type="checkbox" name="musician" value="1" id="profile_type-musician" {{ $post->musician ? 'checked' : '' }}>
          </div>
          <li class="page-item">
            <label for="profile_type-actor" class="page-link" href="#">{{ title_case(__('actor')) }}</label>
          </li>
          <li class="page-item">
            <label for="profile_type-dancer" class="page-link" href="#">{{ title_case(__('dancer')) }}</label>
          </li>
          <li class="page-item">
            <label for="profile_type-entertainer" class="page-link" href="#">{{ title_case(__('entertainer')) }}</label>
          </li>
          <li class="page-item">
            <label for="profile_type-event_staff" class="page-link" href="#">{{ title_case(__('event staff')) }}</label>
          </li>
          <li class="page-item">
            <label for="profile_type-extra" class="page-link" href="#">{{ title_case(__('extra')) }}</label>
          </li>
          <li class="page-item">
            <label for="profile_type-model" class="page-link" href="#">{{ title_case(__('model')) }}</label>
          </li>
          <li class="page-item">
            <label for="profile_type-musician" class="page-link" href="#">{{ title_case(__('musician')) }}</label>
          </li>
        </ul>
      </div>
    </div>
    <div class="card-block">
      <div id="ImageInputs" data-type="{{ $type }}"></div>
    </div>
    <div class="card-block">
      <h5 class="text-muted">{{ ucfirst(__('upload banner')) }}</h5>
      <input name="banner" type="file" class="file">
    </div>
    <div class="card-block">
      <h5 class="text-muted">{{ ucfirst(__('write description')) }}</h5>
      <textarea name="content" class="tinymce">{{ $post->content }}</textarea>
    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-primary">{{ title_case($type) }}</button>
    </div>
  </div>

  @csrf
  @method('POST')
</form>
@endsection