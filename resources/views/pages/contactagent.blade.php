@extends('layouts.master')
@section('content')
<div class="container content-wrapper">

@if (App::isLocale('en')) 

  <h2>{{ title_case(__('do you want to become an agent?')) }}</h2>

  <p>On this page you can send us a request to become an agent. This allows you to make job posts in the system, and view our profiles for headhunting.
  </p>
  
  <h2>{{ title_case(__('contact formular')) }}</h2>
  {{ Form::open(['route' => 'pages.contact']) }}
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
  <div class="form-group {{ $errors->has('company') ? 'has-error' : '' }}">
    {{ Form::label(ucfirst(__('company'))) }}
    {{ Form::text('company', old('company'), ['class' => 'form-control']) }}
    <span class="text-danger">{{ $errors->first('company') }}</span>
  </div>
  <div class="form-group {{ $errors->has('cvr') ? 'has-error' : '' }}">
    {{ Form::label(ucfirst(__('cvr'))) }}
    {{ Form::text('cvr', old('cvr'), ['class' => 'form-control']) }}
    <span class="text-danger">{{ $errors->first('cvr') }}</span>
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

  <h1>{{ title_case(__('contact information')) }}</h1>
  <address>
    Cast Me IVS <br>
    Cvr. 39302845 <br>
    Carl bernhardsvej 13B <br>
    Frederiksberg 1817 <br>
    Tlf: +45 31171877 <br>
    Mail: support@castme.dk <br>
  </address>

</div>

@else

 <h2>Vil du gerne blive agent?</h2>

  <p>Her kan du ansøge om at blive agent. Som agent kan du selv oprette jobopslag, samt søge i blandt vores profiler til headhunting.
  </p>
  
  <h2>Kontaktformular</h2>
  {{ Form::open(['route' => 'pages.contact']) }}
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
  <div class="form-group {{ $errors->has('company') ? 'has-error' : '' }}">
    {{ Form::label(ucfirst(__('company'))) }}
    {{ Form::text('company', old('company'), ['class' => 'form-control']) }}
    <span class="text-danger">{{ $errors->first('company') }}</span>
  </div>
  <div class="form-group {{ $errors->has('cvr') ? 'has-error' : '' }}">
    {{ Form::label(ucfirst(__('cvr'))) }}
    {{ Form::text('cvr', old('cvr'), ['class' => 'form-control']) }}
    <span class="text-danger">{{ $errors->first('cvr') }}</span>
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

  <h1>{{ title_case(__('contact information')) }}</h1>
  <address>
    Cast Me IVS <br>
    Cvr. 39302845 <br>
    Carl bernhardsvej 13B <br>
    Frederiksberg 1817 <br>
    Tlf: +45 31171877 <br>
    Mail: support@castme.dk <br>
  </address>

</div>

@endif

@endsection