@extends('layouts.auth')

@section('content')
<div class="register-box">
  <div class="register-logo">
    @php 
      if (str_contains(config('app.name'), ' ')) {
        list($first, $last) = explode(' ', config('app.name'), 2); 
      } else {
        $first = config('app.name');
      }
    @endphp
    <a href="{{ url()->current() }}">
      <b>{{ $first }}</b>{{ $last }}
    </a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">{{ __('Register a new membership') }}</p>

      <form action="{{ route('register') }}" method="post">
        @csrf

        <div class="form-group has-feedback">
          <input name="name" type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" placeholder="{{ __('Full name') }}" autofocus>
          <div class="invalid-feedback">{{ $errors->first('name') }}</div>
        </div>

        <div class="form-group has-feedback">
          <input name="email" type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" placeholder="{{ __('Email') }}">
          <div class="invalid-feedback">{{ $errors->first('email') }}</div>
        </div>

        <div class="form-group has-feedback">
          <input name="password" type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="{{ __('Password') }}">
          <div class="invalid-feedback">{{ $errors->first('password') }}</div>
        </div>

        <div class="form-group has-feedback">
          <input name="password_confirmation" type="password" class="form-control" placeholder="{{ __('Retype password') }}">
          <div class="invalid-feedback">{{ $errors->first('password') }}</div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="checkbox icheck">
              <label>
                <input type="checkbox"> {{ __('I agree to the') }}
                <a href="#">{{ __('terms') }}</a>
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">{{ __('Register') }}</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center">
        <p>- {{ __('OR') }} -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fa fa-facebook mr-2"></i>
          {{ __('Sign up using Facebook') }}
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fa fa-google-plus mr-2"></i>
          {{ __('Sign up using Google+') }}
        </a>
      </div>

      <a href="{{ route('login') }}" class="text-center">{{ __('I already have a membership') }}</a>
    </div>
    <!-- /.form-box -->
  </div>
  <!-- /.card -->
</div>
@endsection