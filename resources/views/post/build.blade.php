@extends('layouts.master')
@section('content')
<h2 class="page-header">{{ title_case($title) }}</h2>

{{ Form::open(['url' => $form_url, 'files' => 'true']) }}

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
          <li class="page-item">
            <label for="profile_type-actor" class="page-link" href="#">{{ title_case(__('actor')) }}</label>
            {{ Form::label('profile_type-actor', ucfirst(__('actor')), [
              'class' => 'page-link'
            ]) }}
          </li>
          <li class="page-item">
            <label for="profile_type-dancer" class="page-link" href="#">{{ title_case(__('dancer')) }}</label>
            {{ Form::label('profile_type-dancer', ucfirst(__('dancer')), [
              'class' => 'page-link'
            ]) }}
          </li>
          <li class="page-item">
            <label for="profile_type-entertainer" class="page-link" href="#">{{ title_case(__('entertainer')) }}</label>
            {{ Form::label('profile_type-entertainer', ucfirst(__('entertainer')), [
              'class' => 'page-link'
            ]) }}
          </li>
          <li class="page-item">
            <label for="profile_type-event_staff" class="page-link" href="#">{{ title_case(__('event staff')) }}</label>
            {{ Form::label('profile_type-event_staff', ucfirst(__('event_staff')), [
              'class' => 'page-link'
            ]) }}
          </li>
          <li class="page-item">
            <label for="profile_type-extra" class="page-link" href="#">{{ title_case(__('extra')) }}</label>
            {{ Form::label('profile_type-extra', ucfirst(__('extra')), [
              'class' => 'page-link'
            ]) }}
          </li>
          <li class="page-item">
            <label for="profile_type-model" class="page-link" href="#">{{ title_case(__('model')) }}</label>
            {{ Form::label('profile_type-model', ucfirst(__('model')), [
              'class' => 'page-link'
            ]) }}
          </li>
          <li class="page-item">
            <label for="profile_type-musician" class="page-link" href="#">{{ title_case(__('musician')) }}</label>
            {{ Form::label('profile_type-musician', ucfirst(__('musician')), [
              'class' => 'page-link'
            ]) }}
          </li>
          <div class="display-none">
            {{ Form::checkbox('roles[]', 'actor', $post->roles && in_array('actor', json_decode($post->roles)), [
              'id' => 'profile_type-actor'
            ]) }}
            {{ Form::checkbox('roles[]', 'dancer', $post->roles && in_array('dancer', json_decode($post->roles)), [
              'id' => 'profile_type-dancer'
            ]) }}
            {{ Form::checkbox('roles[]', 'entertainer', $post->roles && in_array('entertainer', json_decode($post->roles)), [
              'id' => 'profile_type-entertainer'
            ]) }}
            {{ Form::checkbox('roles[]', 'event_staff', $post->roles && in_array('event_staff', json_decode($post->roles)), [
              'id' => 'profile_type-event_staff'
            ]) }}
            {{ Form::checkbox('roles[]', 'extra', $post->roles && in_array('extra', json_decode($post->roles)), [
              'id' => 'profile_type-extra'
            ]) }}
            {{ Form::checkbox('roles[]', 'model', $post->roles && in_array('model', json_decode($post->roles)), [
              'id' => 'profile_type-model'
            ]) }}
            {{ Form::checkbox('roles[]', 'musician', $post->roles && in_array('musician', json_decode($post->roles)), [
              'id' => 'profile_type-musician'
            ]) }}
          </div>
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

{{ Form::close() }}
@endsection