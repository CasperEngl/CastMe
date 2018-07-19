@extends('master')
@section('content')
  <main class="container">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="/send" method="post">
      <input type="hidden" name="receiver" value="{{ old('to') }}">
      <label>Title
        <input type="text" name="title" value="{{ old('title') }}">
      </label>

      <label>{{ title_case(__('Content')) }}
        <textarea name="content" id="" cols="30" rows="10">{{ old('content') }}</textarea>
      </label>
      <input type="submit">

      {{ csrf_field() }}
    </form>
  </main>
@endsection
