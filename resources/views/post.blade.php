@extends('master')
@section('content')
  <main class="container">
    <h2 class="page-header">{{ title_case(__('New Post')) }}</h2>

    <form action="/post/send" method="POST">

      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-auto">
              <span class="h2">{{ title_case(__('Title')) }}</span>
            </div>
            <div class="col">
              <input type="text" class="form-control bg-transparent">
            </div>
          </div>
        </div>
        <div class="card-block">
          <div class="form-group">
            <h5 class="text-muted">{{ title_case(__('Looking for')) }}</h5>
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

          <div class="form-group">
            <label for="image-1">Image 1</label>
            <div class="row">
              <div class="col">
                <input type="url" name="image" class="form-control text-muted" id="image-1">
              </div>
              <div class="col-auto">
                <button class="btn btn-primary circle"><i class="fas fa-plus"></i></button>
              </div>
            </div>
          </div>

        </div>
        <div class="card-block">
          <textarea name="message" class="tinymce"></textarea>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">{{ title_case(__('Send')) }}</button>
        </div>
      </div>

      {{ csrf_field() }}
    </form>

  </main>
@endsection