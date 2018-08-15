@extends('layouts.master') 
@section('content')
<main class="container">
  <h2 class="page-header">{{ title_case(__('settings dump')) }}</h2>

  <pre>{{ json_encode(Auth::user()->details, JSON_PRETTY_PRINT) }}</pre>

</main>
@endsection