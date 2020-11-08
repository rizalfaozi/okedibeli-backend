<!DOCTYPE html>
<html lang="en" class="coming-soon">
<head>
    <meta charset="utf-8">
    <title>{{ config('app.name') }} | Login </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="description" content="">
    <meta name="author" content="KaijuThemes">
      <meta name="csrf-token" content="{{ Session::token() }}"> 
    

     @include('_patrial.style')   
    
    </head>

    <body class="focused-form">
        
        
<div class="container" id="login-form">
    <a href="{{ url('/home') }}" class="login-logo">
        <img width="128" height="41" src="{{ asset('/images/arkadia.png') }}">
    </a>
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>Login Form</h2></div>
                <div class="panel-body">
                    @if ($errors->has('username'))
                        <div class="mb10 text-danger">
                            <strong>{{ $errors->first('username') }}</strong>
                        </div>
                    @endif

                    @if ($errors->has('password'))
                        <div class="mb10 text-danger">
                            <strong>{{ $errors->first('password') }}</strong>
                        </div>
                    @endif
                    
                    <form method="post"  action="{{ url('/login') }}" class="form-horizontal" id="validate-form">
                         {!! csrf_field() !!}
                        <div class="form-group has-feedback {{ $errors->has('username') ? ' has-error' : '' }}">
                            <div class="col-xs-12">
                                <div class="input-group">                           
                                    <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </span>
                                    <input type="username" name="username" value="{{ old('username') }}" class="form-control" placeholder="Username" data-parsley-minlength="6" placeholder="At least 6 characters" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-key"></i>
                                    </span>
                                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                </div>
                            </div>
                        </div>
                        {{-- 
                        <div class="form-group">
                            <div class="col-xs-12">
                                <a href="{{ url('/password/reset') }}" class="pull-left">Forgot password?</a>
                                <div class="checkbox-inline icheck pull-right pt0">
                                    <label for="">
                                        <input type="checkbox"></input>
                                        Remember me
                                    </label>
                                </div>
                            </div>
                        </div>
                        --}}

                        <div class="panel-footer">
                            <div class="clearfix">
                               <!--  <a href="{{ url('/register') }}" class="btn btn-default pull-left">Register</a> -->
                                 <button type="submit" class="btn btn-primary pull-right">Sign In</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

           <!--  <div class="text-center">
                <a href="{{ url('/auth/facebook') }}" class="btn btn-label btn-social btn-facebook mb20"><i class="fa fa-fw fa-facebook"></i>Connect with Facebook</a>
                <a href="{{ url('/auth/google') }}" class="btn btn-label btn-social btn-googleplus mb20"><i class="fa fa-fw fa-google-plus"></i>Connect with Google + </a>
            </div> -->
        </div>
    </div>
</div>

    
    
@include('_patrial.js_footer')  

    </body>
</html>