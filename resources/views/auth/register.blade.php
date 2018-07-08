@extends('layouts.auth')

@section('content')
<div class="register-box">
  <div class="register-logo">
    @php 
    if (str_contains(config('app.name'), ' ')) { 
      list($first, $last) = explode(' ', config('app.name'), 2); 
    } else {
      $first = config('app.name'); } 
    @endphp
    <a href="{{ url()->current() }}">
      <b>{{ $first }}</b>{{ $last ?? null }}
    </a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">{{ __('Register a new membership') }}</p>

      <form action="{{ route('register') }}" method="post">
        @csrf

        <div class="form-group has-feedback">
          <input name="name" type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ old('name', session('user.social.name')) }}"
            placeholder="{{ __('Full name') }}" autofocus>
          <div class="invalid-feedback">{{ $errors->first('name') }}</div>
        </div>

        <div class="form-group has-feedback">
          <input name="email" type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email') }}"
            placeholder="{{ __('Email') }}">
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
                <a href="#" data-toggle="modal" data-target="#termModal">{{ __('terms') }}</a>
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
        <a href="{{ route('social.redirect', 'facebook') }}" class="btn btn-block btn-primary {{ !config('services.facebook.client_id') ? 'disabled' : '' }}"">
          <i class="fa fa-facebook mr-2"></i>
          {{ __('Register using Facebook') }}
        </a>
        <a href="{{ route('social.redirect', 'google') }}" class="btn btn-block btn-danger {{ !config('services.google.client_id') ? 'disabled' : '' }}"">
          <i class="fa fa-google-plus mr-2"></i>
          {{ __('Register using Google+') }}
        </a>
      </div>

      <a href="{{ route('login') }}" class="text-center">{{ __('I already have a membership') }}</a>
    </div>
    <!-- /.form-box -->
  </div>
  <!-- /.card -->
</div>

<div class="modal fade" id="termModal" tabindex="-1" role="dialog" aria-labelledby="termModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{ __('Terms & Conditions') }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body term-body">
        <h1>Terms and Conditions for
          <span class="highlight preview_company_name">"{{ config('app.name') }}"</span>
        </h1>

        <h2>Introduction</h2>

        <p>These Website Standard Terms and Conditions written on this webpage shall manage your use of our website,
          <span class="highlight preview_website_name">Webiste Name</span> accessible at
          <span class="highlight preview_website_url">Website.com</span>.</p>

        <p>These Terms will be applied fully and affect to your use of this Website. By using this Website, you agreed to accept
          all terms and conditions written in here. You must not use this Website if you disagree with any of these Website
          Standard Terms and Conditions.</p>

        <p>Minors or people below 18 years old are not allowed to use this Website.</p>

        <h2>Intellectual Property Rights</h2>

        <p>Other than the content you own, under these Terms,
          <span class="highlight preview_company_name">Company Name</span> and/or its licensors own all the intellectual property rights and materials contained in this
          Website.</p>

        <p>You are granted limited license only for purposes of viewing the material contained on this Website.</p>

        <h2>Restrictions</h2>

        <p>You are specifically restricted from all of the following:</p>

        <ul>
          <li>publishing any Website material in any other media;</li>
          <li>selling, sublicensing and/or otherwise commercializing any Website material;</li>
          <li>publicly performing and/or showing any Website material;</li>
          <li>using this Website in any way that is or may be damaging to this Website;</li>
          <li>using this Website in any way that impacts user access to this Website;</li>
          <li>using this Website contrary to applicable laws and regulations, or in any way may cause harm to the Website, or
            to any person or business entity;</li>
          <li>engaging in any data mining, data harvesting, data extracting or any other similar activity in relation to this
            Website;</li>
          <li>using this Website to engage in any advertising or marketing.</li>
        </ul>

        <p>Certain areas of this Website are restricted from being access by you and
          <span class="highlight preview_company_name">Company Name</span> may further restrict access by you to any areas of this Website, at any time, in absolute discretion.
          Any user ID and password you may have for this Website are confidential and you must maintain confidentiality as
          well.</p>

        <h2>Your Content</h2>

        <p>In these Website Standard Terms and Conditions, “Your Content” shall mean any audio, video text, images or other
          material you choose to display on this Website. By displaying Your Content, you grant
          <span class="highlight preview_company_name">Company Name</span> a non-exclusive, worldwide irrevocable, sub licensable license to use, reproduce, adapt, publish,
          translate and distribute it in any and all media.</p>

        <p>Your Content must be your own and must not be invading any third-party's rights.
          <span class="highlight preview_company_name">Company Name</span> reserves the right to remove any of Your Content from this Website at any time without notice.</p>

        <h2>No warranties</h2>

        <p>This Website is provided “as is,” with all faults, and
          <span class="highlight preview_company_name">Company Name</span> express no representations or warranties, of any kind related to this Website or the materials
          contained on this Website. Also, nothing contained on this Website shall be interpreted as advising you.</p>

        <h2>Limitation of liability</h2>

        <p>In no event shall
          <span class="highlight preview_company_name">Company Name</span>, nor any of its officers, directors and employees, shall be held liable for anything arising
          out of or in any way connected with your use of this Website whether such liability is under contract. &nbsp;
          <span
            class="highlight preview_company_name">Company Name</span>, including its officers, directors and employees shall not be held liable for any indirect,
            consequential or special liability arising out of or in any way related to your use of this Website.</p>

        <h2>Indemnification
          <p></p>

          <p>You hereby indemnify to the fullest extent
            <span class="highlight preview_company_name">Company Name</span> from and against any and/or all liabilities, costs, demands, causes of action, damages and
            expenses arising in any way related to your breach of any of the provisions of these Terms.</p>

        </h2>
        <h2>Severability</h2>

        <p>If any provision of these Terms is found to be invalid under any applicable law, such provisions shall be deleted
          without affecting the remaining provisions herein.</p>

        <h2>Variation of Terms</h2>

        <p>
          <span class="highlight preview_company_name">Company Name</span> is permitted to revise these Terms at any time as it sees fit, and by using this Website you
          are expected to review these Terms on a regular basis.</p>

        <h2>Assignment</h2>

        <p>The
          <span class="highlight preview_company_name">Company Name</span> is allowed to assign, transfer, and subcontract its rights and/or obligations under these Terms
          without any notification. However, you are not allowed to assign, transfer, or subcontract any of your rights and/or
          obligations under these Terms.</p>

        <h2>Entire Agreement</h2>

        <p>These Terms constitute the entire agreement between
          <span class="highlight preview_company_name">Company Name</span> and you in relation to your use of this Website, and supersede all prior agreements and understandings.</p>

        <h2>Governing Law &amp; Jurisdiction</h2>

        <p>These Terms will be governed by and interpreted in accordance with the laws of the State of
          <span class="highlight preview_country">Country</span>, and you submit to the non-exclusive jurisdiction of the state and federal courts located in
          <span
            class="highlight preview_country">Country</span> for the resolution of any disputes.</p>

        <a href="https://termsandcondiitionssample.com">These terms and conditions have been generated at Terms And Conditions Sample.com</a>
        <p></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
        <button type="button" class="btn btn-primary">{{ __('OK') }}</button>
      </div>
    </div>
  </div>
</div>
@endsection @push('js')
<script>
  $(function () {
    $('.term-body').slimScroll({
      height: '250px'
    })
  })
</script>
@endpush