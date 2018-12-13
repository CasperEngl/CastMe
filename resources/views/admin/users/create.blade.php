@extends('layouts.master') 
@section('content')
<div class="row justify-content-center">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header">{{ ucfirst(__('register')) }}</div>

      <div class="card-body">
        <form action="{{ route('admin.users.create') }}" method="POST" aria-label="{{ ucfirst(__('register')) }}">
          @csrf
          @method('POST')

          <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">{{ ucfirst(__('name')) }}</label>

            <div class="col-md-6">
              <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus> 
              @if ($errors->has('name'))
              <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('name') }}</strong></span>
              @endif
            </div>
          </div>

          <div class="form-group row">
            <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ ucfirst(__('last name')) }}</label>
          
            <div class="col-md-6">
              <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name') }}" required> @if ($errors->has('last_name'))
              <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('last_name') }}</strong></span> @endif
            </div>
          </div>

          <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{ ucfirst(__('e-mail address')) }}</label>

            <div class="col-md-6">
              <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
              @if ($errors->has('email'))
              <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('email') }}</strong></span>
              @endif
            </div>
          </div>

          <div class="form-group row">
            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ ucfirst(__('phone number')) }}</label>

            <div class="col-md-6">
              <input id="phone" type="phone" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" required>
              @if ($errors->has('phone'))
              <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('phone') }}</strong></span>
              @endif
            </div>
          </div>

          <div class="form-group row mb-0">
            <div class="col-md-12 justify-content-center align-items-center">
              <button type="submit" class="btn btn-castme w-100">{{ ucfirst(__('register')) }}</button>
            </div>
          </div>
        </form>

      </div>
    </div>
  </div>
</div>
@endsection