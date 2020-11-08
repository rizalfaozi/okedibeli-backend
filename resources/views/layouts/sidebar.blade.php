<div class="static-sidebar-wrapper sidebar-midnightblue">
                    <div class="static-sidebar">
                        <div class="sidebar">

<div class="widget stay-on-collapse" id="widget-welcomebox">
    <div class="widget-body welcome-box tabular">
        <div class="tabular-row">
           <!--  <div class="tabular-cell welcome-avatar">
                <a href="#"><img src="http://placehold.it/300&text=Placeholder" class="avatar"></a>
            </div> -->
            <div class="tabular-cell welcome-options">
                <span class="welcome-text">Selamat Datang,</span>
                <a href="#" class="name">{!! Auth::user()->name !!}</a>
                <div class="mt30">
                    <a href="{{ url('users/changepassword') }}" class="btn btn-label btn-social btn-youtube"><i class="fa fa-key"></i>Change Password</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="widget stay-on-collapse" id="widget-sidebar">
    <nav role="navigation" class="widget-body">
        <ul class="acc-menu">
      @include('layouts.menu')
        </ul>
    </nav>
</div>



        </div>
    </div>
</div>