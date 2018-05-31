@section('content')
<div class="error-page">
  <h2 class="headline text-danger">500</h2>

  <div class="error-content">
    <h3>
      <i class="fa fa-warning text-danger"></i> {{ __('Oops! Something went wrong.') }}</h3>

    <p>
      {{ __('We will work on fixing that right away. Meanwhile, you may return to dashboard or try using the search form.') }}
    </p>

    <form class="search-form">
      <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Search">

        <div class="input-group-append">
          <button type="submit" name="submit" class="btn btn-danger">
            <i class="fa fa-search"></i>
          </button>
        </div>
      </div>
      <!-- /.input-group -->
    </form>
  </div>
</div>
@endsection