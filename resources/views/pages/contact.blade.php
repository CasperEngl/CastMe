@extends('layouts.static')

@section('content')
<div class="container">
  {{ Form::open(['route' => 'contact.post']) }}
 
  <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    {{ Form::label(ucfirst(__('name'))) }}
    {{ Form::text('name', old('name'), ['class' => 'form-control']) }}
    <span class="text-danger">{{ $errors->first('name') }}</span>
  </div>
  
  <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
    {{ Form::label(ucfirst(__('email'))) }}
    {{ Form::text('email', old('email'), ['class' => 'form-control']) }}
    <span class="text-danger">{{ $errors->first('email') }}</span>
  </div>
  
  <div class="form-group {{ $errors->has('message') ? 'has-error' : '' }}">
    {{ Form::label(ucfirst(__('message'))) }}
    {{ Form::textarea('message', old('message'), ['class' => 'form-control']) }}
    <span class="text-danger">{{ $errors->first('message') }}</span>
  </div>
  
  <div class="form-group">
    <button class="btn btn-castme">{{ ucfirst(__('contact')) }}</button>
  </div>
  
  {{ Form::close() }}
</div>
@endsection