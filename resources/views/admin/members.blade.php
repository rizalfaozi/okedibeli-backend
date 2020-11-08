@extends('layouts.app')

@section('content')
 <div class="page-heading">            
            <h1>Members</h1>
        </div>


        <ol class="breadcrumb">
            <li class=""><a href="{{ url('home') }}">Home</a></li>
            <li class="active"><a href="#">Members</a></li>
        </ol>

@include('flash::message')

<div class="container-fluid">
    
    <div id="app-{{ $vuejs }}">
        <transition name="fade">
           <router-view></router-view>
        </transition>
    </div>
    
</div> 



@endsection

