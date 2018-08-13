@extends('layouts.master')
@section('content')
  <main class="container">
    <h2 class="page-header">{{ title_case(__('conversations')) }}</h2>
    
    <div class="card">
      <div class="card-header">Your latest conversations</div>
      <div class="list-group list-group-flush">
        {{-- 
        @foreach ($conversations as $conversation)
        <a href="/conversation/{{ $conversation->id }}" class="list-group-item">
          {{ $conversation->peer }}
          @if ($conversation->unread_count > 0)
          <span class="badge badge-danger">{{ $conversation->unread_count }}</span>
          @endif
        </a>
        @endforeach
        --}}
        <a href="/conversation/1" class="list-group-item">
          Jack Goff
          <span class="badge badge-danger">2</span>
        </a>
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