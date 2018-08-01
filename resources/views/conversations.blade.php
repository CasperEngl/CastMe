@extends('master')
@section('content')
  <main class="container">
    <h2 class="page-header">{{ title_case(__('Conversations')) }}</h2>
    
    <div class="card">
      <div class="card-header">Your latest conversations</div>
      <div class="list-group list-group-flush">
        <a href="/conversation" class="list-group-item">
          Dixie Normous
        </a>
        <a href="/conversation" class="list-group-item">
          Jack Goff <span class="badge badge-danger">2</span>
        </a>
        <a href="/conversation" class="list-group-item">
          Dick Pound
        </a>
        <a href="/conversation" class="list-group-item">
          Heath Cockburn
        </a>
        <a href="/conversation" class="list-group-item">
          Mike Weiner
        </a>
        <a href="/conversation" class="list-group-item">
          Chew Kok <span class="badge badge-danger">5</span>
        </a>
        <a href="/conversation" class="list-group-item">
          Robert Fagot
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