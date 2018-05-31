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
      <p class="login-box-msg">{{ __('Sign in to start your session') }}</p>

      <form action="{{ route('login') }}" method="post">
        @csrf

        <div class="form-group has-feedback">
          <input name="email" type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{ __('Email') }}" autofocus>
          <div class="invalid-feedback">{{ $errors->first('email') }}</div>
        </div>

        <div class="form-group has-feedback">
          <input name="password" type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="{{ __('Password') }}">
          <div class="invalid-feedback">{{ $errors->first('password') }}</div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="checkbox icheck">
              <label>
                <input name="remember" type="checkbox"> {{ __('Remember Me') }}
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">{{ __('Sign In') }}</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center mb-3">
        <p>- {{ __('OR') }} -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fa fa-facebook mr-2"></i> {{ __('Sign in using Facebook') }}
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fa fa-google-plus mr-2"></i> {{ __('Sign in using Google+') }}
        </a>
      </div>
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="{{ route('password.request') }}">{{ __('I forgot my password') }}</a>
      </p>
      <p class="mb-0">
        <a href="{{ route('register') }}" class="text-center">{{ __('Register a new membership') }}</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
@endsection