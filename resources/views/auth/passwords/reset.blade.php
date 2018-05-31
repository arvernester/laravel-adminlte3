@extends('layouts.auth')

@section('content')
<div class="login-box">
    <div class="login-logo">
      @php 
        if (str_contains(config('app.name'), ' ')) {
          list($first, $last) = explode(' ', config('app.name'), 2); 
        } else {
          $first = config('app.name');
        }
      @endphp
      <a href="{{ url()->current() }}">
        <b>{{ $first }}</b>{{ $last ?? '' }}</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        @if (session('status'))
          <div class="alert alert-success">
              {{ session('status') }}
          </div>
        @endif
        
        <p class="login-box-msg">{{ __('Reset password') }}</p>
  
        <form action="{{ route('password.request') }}" method="post">
          @csrf

          <input type="hidden" name="token" value="{{ $token }}">
  
          <div class="form-group has-feedback">
            <input name="email" type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" placeholder="{{ __('Email') }}" autofocus>
            <div class="invalid-feedback">{{ $errors->first('email') }}</div>
          </div>
          
          <div class="form-group has-feedback">
            <input name="password" type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="{{ __('Password') }}">
            <div class="invalid-feedback">{{ $errors->first('email') }}</div>
          </div>
          
          <div class="form-group has-feedback">
            <input name="password_confirmation" type="password" class="form-control" placeholder="{{ __('Password confirmation') }}">
          </div>
  
          <div class="row">
            <!-- /.col -->
            <div class="col-12 pull-right">
              <button type="submit" class="btn btn-primary btn-block btn-flat">{{ __('Reset Password') }}</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
  
        <p class="mb-1 mt-3">
            <a href="{{ route('login') }}" class="text-center">{{ __('I already have a membership') }}</a>
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
@endsection