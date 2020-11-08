<!DOCTYPE html>
<html lang="en" class="coming-soon">
<head>
    <meta charset="utf-8">
    <title>{{ config('app.name') }} | Reset Pasword </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="description" content="">
    <meta name="author" content="KaijuThemes">

    

     @include('_patrial.style')   
    
    </head>

    <body class="focused-form">
        
        
<div class="container" id="login-form">
    <a href="{{ url('/home') }}" class="login-logo">
        <img width="128" height="41" src="{{ asset('/images/arkadia.png') }}">
    </a>

    

        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                
                     @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif
               
             </div>
        </div>        

    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>Reset Password</h2></div>
                <div class="panel-body">
                    
                    <form method="post"  action="{{ url('/lupakirim') }}" class="form-horizontal" id="validate-form">
                         {!! csrf_field() !!}
                        <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="col-xs-12">
                                <div class="input-group">                           
                                    <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </span>
                                    <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email " data-parsley-minlength="6" placeholder="At least 6 characters" required>
                                </div>
                            </div>
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                        </div>

                      
                     
                    

                        <div class="panel-footer">
                            <div class="clearfix">
                                
                                 <button type="submit" class="btn btn-primary pull-right">Kirim </button>
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