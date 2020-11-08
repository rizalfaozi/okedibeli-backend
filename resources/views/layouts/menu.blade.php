
<li class="nav-separator">Menu</li>
<li><a href="{{ url('') }}"><i class="fa fa-home"></i><span>Dashboard</span></a></li>

<li class="hasChild"><a href="javascript:;"><i class="fa fa-fw fa-user"></i><span> Akun </span></a>
	<ul class="acc-menu" >
		<li><a href="{!! route('users.index') !!}"><i class="fa fa-circle"></i><span> Admin</span></a></li>
		<li class="">
    		<a href="{!! route('members.index') !!}"><i class="fa fa-circle"></i><span> Member</span></a>
		</li>
		<!--
		<li class="">
    		<a href="{!! url('comments') !!}"><i class="fa fa-circle"></i><span> List Komentar</span></a>
		</li>
		-->

	</ul>
</li>

<li class="hasChild"><a href="javascript:;"><i class="fa fa-fw fa-bars"></i><span> Menu </span></a>
	<ul class="acc-menu" >
		<li class="">
    		<a href="{!! route('themes.index') !!}"><i class="fa fa-circle"></i><span> Themes</span></a>
		</li>

		<li class="">
    		<a href="{!! route('fiture.index') !!}"><i class="fa fa-circle"></i><span> Fiture</span></a>
		</li>

		<li class="">
    		<a href="{!! route('news.index') !!}"><i class="fa fa-circle"></i><span> News</span></a>
		</li>
		
	</ul>
</li>


<li class="hasChild"><a href="javascript:;"><i class="fa fa-fw fa-cogs"></i><span> Setup </span></a>
	<ul class="acc-menu" >
		<li class="">
    		<a href="{!! route('profile.index') !!}"><i class="fa fa-circle"></i><span> Profile</span></a>
		</li>

		<li class="">
    		<a href="{!! route('contact.index') !!}"><i class="fa fa-circle"></i><span> Contact</span></a>
		</li>
	</ul>
</li>










