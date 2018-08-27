@extends('layouts.master')
@section('content')
  <main class="container">
    <h2 class="page-header">{{ title_case(__('conversations')) }}</h2>
    
    <div class="card">
      <div class="card-header">{{ ucfirst(__('your conversations')) }}</div>
      <div class="list-group">
        @foreach ($conversations as $conversation)
        <a href="{{ route('conversation', ['id' => $conversation['id']]) }}" class="list-group-item">
          {{ $conversation['name'] }} {{ $conversation['last_name'] }}
          <span class="badge badge-danger">{{ ucfirst(__('unread')) }}</span>
        </a>
        @endforeach
      </div>
      <!--
      <div class="card-footer">
        <nav aria-label="Page navigation example">
          <ul class="pagination">
            <li class="page-item">
              <a class="page-link" href="#">Previous</a>
            </li>
            <li class="page-item active">
              <a class="page-link" href="#">1</a>
            </li>
            <li class="page-item">
              <a class="page-link" href="#">2</a>
            </li>
            <li class="page-item">
              <a class="page-link" href="#">3</a>
            </li>
            <li class="page-item">
              <a class="page-link" href="#">Next</a>
            </li>
          </ul>
        </nav>
      </div>
      -->
    </div>
    
  </main>
@endsection