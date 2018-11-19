<?php

use App\PostRole;

?>

@extends('layouts.master')
@section('content')
<h2 class="page-header">{{ ucfirst($title) }}</h2>

{{ Form::open(['url' => $form_url, 'files' => 'true']) }}

  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col-auto">
          <span class="h3">{{ ucfirst(__('title')) }}</span>
        </div>
        <div class="col">
          <input type="text" name="title" class="form-control bg-transparent" value="{{ $post->title }}" placeholder="{{ $post->title }}">
        </div>
      </div>
    </div>

    <div class="card-block">
      <div class="form-group">
        <h5>{{ ucfirst(__('location')) }}</h5>
        <p class="text-muted">{{ sentence(__('location for the job. this guides users to find your job in their local area.')) }}</p>
        <p class="text-muted">{{ sentence(__('')) }}</p>
        {{ Form::text('location', $post->location, [
          'class' => 'form-control'
        ]) }}
      </div>
    </div>

   <div class="card-block">
      <div class="form-group">
        <h5>{{ ucfirst(__('region')) }}</h5>
        <p class="text-muted">{{ sentence(__('region in denmark')) }}</p>
        <div class="form-group">
          <ul class="pagination">
            <li class="page-item">
              {{ Form::label('region-capital_area', title_case(__('capital area')), [
                'class' => 'page-link'
              ]) }}
            </li>
            <li class="page-item">
              {{ Form::label('region-zealand', title_case(__('zealand')), [
                'class' => 'page-link'
              ]) }}
            </li>
            <li class="page-item">
              {{ Form::label('region-funen', title_case(__('funen')), [
                'class' => 'page-link'
              ]) }}
            </li>
            <li class="page-item">
              {{ Form::label('region-northern_jutland', title_case(__('northern jutland')), [
                'class' => 'page-link'
              ]) }}
            </li>
            <li class="page-item">
              {{ Form::label('region-mid_jutland', title_case(__('mid jutland')), [
                'class' => 'page-link'
              ]) }}
            </li>
            <li class="page-item">
              {{ Form::label('region-south_denmark', title_case(__('south denmark')), [
                'class' => 'page-link'
              ]) }}
            </li>
            <div class="display-none">
              <input type="radio" name="region" value="capital_area" id="region-capital_area" {{ ($post->region == 'capital_area') ? 'checked' : '' }}>
              <input type="radio" name="region" value="zealand" id="region-zealand" {{ ($post->region == 'zealand') ? 'checked' : '' }}>
              <input type="radio" name="region" value="funen" id="region-funen" {{ ($post->region == 'funen') ? 'checked' : '' }}>
              <input type="radio" name="region" value="northern_jutland" id="region-northern_jutland" {{ ($post->region == 'northern_jutland') ? 'checked' : '' }}>
              <input type="radio" name="region" value="mid_jutland" id="region-mid_jutland" {{ ($post->region == 'mid_jutland') ? 'checked' : '' }}>
              <input type="radio" name="region" value="south_denmark" id="region-south_denmark" {{ ($post->region == 'south_denmark') ? 'checked' : '' }}>
            </div>
          </ul>
        </div>
      </div>
    </div>

    <div class="card-block">
      <div class="form-group">
        <h5>{{ ucfirst(__('looking for')) }}</h5>
        <p class="text-muted">{{ ucfirst(__('select multiple if applicable')) }}</p>
        <ul class="pagination">
          @foreach (PostRole::getPossibleRoles() as $postRole)
          <li class="page-item">
            {{ Form::label(str_slug($postRole, '_'), ucfirst(__(str_replace('_', ' ', $postRole))), [
              'class' => 'page-link'
            ]) }}
          </li>
          @endforeach
          <div class="display-none">
            @foreach (PostRole::getPossibleRoles() as $postRole)
            {{ Form::checkbox('roles[]', str_slug($postRole, '_'), array_where($post->postRoles->toArray(), function($value, $key) use ($postRole) {
              return str_slug($value['role'], '_') === str_slug($postRole, '_');
            }), [
              'id' => str_slug($postRole, '_'),
            ]) }}
            @endforeach
          </div>
        </ul>
      </div>
    </div>
    <div class="card-block">
      <div id="ImageInputs" data-type="{{ $type }}"></div>
    </div>
    <div class="card-block">
      <h5>{{ ucfirst(__('upload banner')) }}</h5>
      <p class="text-muted m-0">{{ ucfirst(__('preferably 825x400 or above pixels')) }}</p>
      <p class="text-muted small">{{ ucfirst(__('aspect ratio 2,0625:1')) }}</p>
      <input name="banner" type="file" class="file">
    </div>
    <div class="card-block">
      <h5>{{ ucfirst(__('write description')) }}</h5>
      <textarea name="content" class="tinymce">{{ $post->content }}</textarea>
    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-castme">{{ ucfirst($type) }}</button>
    </div>
  </div>

{{ Form::close() }}
@endsection