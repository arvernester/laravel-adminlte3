@extends('layouts.plain')

@section('content')
<div class="lockscreen-wrapper">
  <div class="lockscreen-logo">
    <a href="{{ url()->current() }}">
      @php 
        if (str_contains(config('app.name'), ' ')) {
          list($first, $last) = explode(' ', config('app.name'), 2); 
        } else {
          $first = config('app.name');
        }
      @endphp
      <b>{{ $first }}</b>{{ $last ?? '' }}</a>
    </a>
  </div>
  <!-- User name -->
  <div class="lockscreen-name">{{ optional(auth()->user())->name ?? __('Guest') }}</div>

  <!-- START LOCK SCREEN ITEM -->
  <div class="lockscreen-item">
    <!-- lockscreen image -->
    <div class="lockscreen-image">
      <img src="{{ optional(auth()->user())->gravatar ?? 'http://via.placeholder.com/128x128' }}" alt="{{ optional(auth()->user())->name }}">
    </div>
    <!-- /.lockscreen-image -->

    <!-- lockscreen credentials (contains the form) -->
    <form class="lockscreen-credentials">
      <div class="input-group">
        <input type="password" class="form-control" placeholder="password">

        <div class="input-group-append">
          <button type="button" class="btn">
            <i class="fa fa-arrow-right text-muted"></i>
          </button>
        </div>
      </div>
    </form>
    <!-- /.lockscreen credentials -->

  </div>
  <!-- /.lockscreen-item -->
  <div class="help-block text-center">
    {{ __('Enter your password to retrieve your session') }}
  </div>
  <div class="text-center">
    <a href="{{ route('logout') }}">{{ __('Or sign in as a different user') }}</a>
  </div>
  <div class="lockscreen-footer text-center">
    {{ __('Copyright') }} &copy; 2014-2018
    <b>
      <a href="http://adminlte.io" class="text-black">AdminLTE.io</a>
    </b>
    <br> {{ __('All rights reserved') }}
  </div>
</div>
@endsection