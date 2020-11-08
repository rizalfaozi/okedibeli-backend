<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{ config('app.name') }} | {{ $page }}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ Session::token() }}"> 
        @include('_patrial.style')  

    <script type="text/javascript">
        const BASE_URL = "{{url('/')}}";
    </script>

    </head>

    <body class="infobar-offcanvas">
        @if (!Auth::guest())    
            <header id="topnav" class="navbar navbar-midnightblue navbar-fixed-top clearfix" role="banner">
                <span id="trigger-sidebar" class="toolbar-trigger toolbar-icon-bg">
                    <a data-toggle="tooltips" data-placement="right" title="Toggle Sidebar"><span class="icon-bg"><i class="fa fa-fw fa-bars"></i></span></a>
                </span>

                <a class="navbar-brand" href="#">
                    <img style="margin:-13px 0px;" width="128" height="41" src="{{ asset('/images/arkadia.png') }}">
                </a>

                <ul class="nav navbar-nav toolbar pull-right">
                    <li class="toolbar-icon-bg hidden-xs" id="trigger-fullscreen">
                        <a href="#" class="toggle-fullscreen"><span class="icon-bg"><i class="fa fa-fw fa-arrows-alt"></i></span></i></a>
                    </li>
                    <li class="toolbar-icon-bg hidden-xs mr20">
                        <a href="{!! url('/logout') !!}"><span class="icon-bg" style="width: 100px;"><i class="icon-bg fa fa-sign-out mr10"></i>Log Out</span></a>
                    </li>

                    <!--
                    <li class="dropdown toolbar-icon-bg">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="icon-bg"><i class="fa fa-fw fa-user"></i></span></a>
                        <ul class="dropdown-menu userinfo arrow">
                            <li><a href="{!! url('/profile') !!}"><span class="pull-left">Profile</span> <span class="badge badge-info"></span></a></li>
                            <li><a href="{!! url('/editpswd') !!}"><span class="pull-left">Update Password</span> <span class="badge badge-info"></span></a></li>
                           
                            <li class="divider"></li>
                            <li><a href="{!! url('/logout') !!}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><span class="pull-left">Sign Out</span> <i class="pull-right fa fa-sign-out"></i></a>
                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                            </li>
                        </ul>
                    </li>
                    -->

                </ul>
            </header>
            <div id="wrapper">
                <div id="layout-static">      
                    <!-- Left side column. contains the logo and sidebar -->
                    @include('layouts.sidebar')
                    <div class="static-content-wrapper">
                        <div class="static-content">
                            <div class="page-content">
                            @yield('content')
                            </div>  
                        </div>
                        <footer role="contentinfo">
                            <div class="clearfix">
                                <ul class="list-unstyled list-inline pull-left">
                                    <li><h6 style="margin: 0;"> &copy; {{ config('app.footer') }}</h6></li>
                                </ul>
                                <button class="pull-right btn btn-link btn-xs hidden-print" id="back-to-top"><i class="fa fa-arrow-up"></i></button>
                            </div>
                        </footer>
                    </div>
                </div>
            </div>
            @include('_patrial.js_footer')  

            @else

            <script>window.location.href = BASE_URL+'/login';</script>

            @endif
    </body>
</html>