<!DOCTYPE html>
<html lang="en" class="coming-soon">
<head>
    <meta charset="utf-8">
    <title>{{ config('app.name') }} | Reset Password </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="description" content="">
    <meta name="author" content="KaijuThemes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    

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
                <div class="panel-heading"><h2>Reset Password</h2></div>
                <div class="panel-body">
                    
                    <form  method="post" action="{{ url('/forgotSend') }}" class="form-horizontal">
                    {!! csrf_field() !!}

                          <input type="hidden" name="email" value="{{ $status->email }}">
                        
                        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="Email" class="col-xs-4 control-label">Email</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control" name="email" value="{{ $status->email }}" id="Email" placeholder="Email"disabled="disabled">
                            </div>
                             
                        </div>

                      

                        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="Password" class="col-xs-4 control-label">Password</label>
                            <div class="col-xs-8">
                                <input type="password" class="form-control" name="password" id="Password" placeholder="Password" required>
                            </div>
                             @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="ConfirmPassword" class="col-xs-4 control-label">Confirm Password</label>
                            <div class="col-xs-8">
                                <input type="password" class="form-control" name="password_confirmation" id="ConfirmPassword" placeholder="Confirm Password" required>
                            </div>
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                            @endif
                        </div>
                      
                        
                    
                    <div class="panel-footer">
                        <div class="clearfix">
                           
                            <button type="submit" class="btn btn-primary pull-right">Reset Password</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>

            
        </div>
    </div>
</div>

    
    
@include('_patrial.js_footer')  

    </body>
</html>