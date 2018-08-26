@extends('layouts.master')
@section('content')
  <main class="container">
    <h2 class="page-header">{{ title_case(__('conversations')) }}</h2>
    
    <div class="card">
      <div class="card-header">Your latest conversations</div>
      <div class="list-group list-group-flush">
        @foreach ($conversations as $conversation)
        <a href="/conversation/{{ $conversation->sender_id }}" class="list-group-item">
          {{ Auth::user()->find($conversation->sender_id)->name }}
          @if ($conversation->read < 1)
          <span class="badge badge-danger">{{ ucfirst(__('unread')) }}</span>
          @endif
        </a>
        @endforeach
      </div>
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
    </div>
    
  </main>
@endsection