@extends('master')
@section('content')
  <main class="container">
    <h2 class="page-header">Profiloplysninger</h2>

    <div class="card">
      <div class="card-body">
        <div class="card-title">Upload profile picture</div>
        <div class="file-upload">
          <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Add Image</button>
        
          <div class="image-upload-wrap">
            <input class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" />
            <div class="drag-text">
              <h3>Drag and drop a file or select add Image</h3>
            </div>
          </div>
          <div class="file-upload-content">
            <img class="file-upload-image" src="#" alt="your image" />
            <div class="image-title-wrap">
              <span class="image-title">Uploaded Image</span>
            </div>
          </div>
        </div>

        

      </div>
    </div>
  </main>
@endsection