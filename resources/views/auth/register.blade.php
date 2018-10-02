@extends('layouts.login')

@section('content')
<style type="text/css">  

</style>
<div class="login-bg signup">
    <h4>Invest Now and enjoy Good Discounts 
    <!-- <span class="login-p">(Grand Discount "<strong>50% till 13th July</strong>")</span> -->
    </h4>
<div class="container">
        <div class="pull-right col-lg-4">
            <div class="panel panel-default">
                <!-- <div class="panel-heading">Register</div> -->

                <div class="panel-body">
                    <a class="logo navbar-brand" href="https://aarnav.io/">
                       <img src="{{ img(Setting::get('site_logo')) }}" height="50" alt="{{ Setting::get('site_title') }}">
                    </a>

                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
                        @if(Request::get('referral'))
                            <input type="hidden" name="referral" value="{{ Request::get('referral') }}">
                        @endif

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="control-label">Full Legal Name</label>

                            <div class="">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="control-label">E-Mail Address</label>

                            <div class="">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

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
                            <label for="password-confirm" class="control-label">Confirm Password</label>

                            <div class="">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
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
                                    Register
                                </button>
                            </div>
                        </div>
                    
                        <div class="form-group bypass-pages">
                            <p>Already have an account? <a href="{{url('/login')}}" class="register-text">Login</a></p>
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