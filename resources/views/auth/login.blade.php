@extends('layouts.login')

@section('content')
<style type="text/css">

</style>

<div class="login-bg login">
    <h4><b>Aarnav</b> Security Token Offering</b>
    <!-- <span class="login-p">(Grand Discount "<strong>50% till 13th July</strong>")</span> -->
    </h4>
<div class="">
        <div class="pull-right col-lg-4 login-formsection">
            <div class="panel panel-default">
                <!-- <div class="panel-heading">Login</div> -->

                <div class="panel-body">
                    <a class="logo navbar-brand" href="https://aarnav.io/">
                       <img src="{{ img(Setting::get('site_logo')) }}" height="50" alt="{{ Setting::get('site_title') }}">
                    </a>
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="control-label">E-Mail Address</label>

                            <div class="">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="control-label">Password</label>

                            <div class="">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="">
                                <div class="checkbox">
                                    <div class="g-recaptcha" data-sitekey="6LeipUsUAAAAABAnNhG5giTpQjJhc661UZS7VTN0"></div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link forget-password" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>

                        <div class="form-group bypass-pages">
                            <p>Don't have an account? <a href="{{url('/register')}}" class="register-text">Register</a></p>
                        </div>

                    </form>
                </div>
            </div>
        </div>
</div>
</div>
@endsection

@section('scripts')
    <script>
    $("form").submit(function(event) {

       var recaptcha = $("#g-recaptcha-response").val();
       if (recaptcha === "") {
          event.preventDefault();
          alert("Please check the recaptcha");
       }
    });
    </script>
@endsection