<div class="container headerContainer">
	<a href="{{ url('/') }}">
		<img class="logo pull-left" id="header-logo" src="http://www.verticalbookingusa.com/images/logo.png">
	</a>
	<ul class="nav">
	  	<li>
	  		<a href="{{ url('/') }}" class="{{Request::is('/', 'article*')?'active':''}}">Articles</a>
	  		<ul>
				<li><a href="{{ url('/articleList') }}" class="{{Request::is('articleList')?'active':''}}">Article List</a></li>
				<li><a href="{{ url('/articleTree') }}" class="{{Request::is('articleTree')?'active':''}}">Article Tree</a></li>
				<li><a href="{{ url('/articleGUI') }}" class="{{Request::is('articleGUI')?'active':''}}">Article GUI</a></li>
			</ul>
	  	</li>
	  	@if (Auth::check())
		  <li><a href="{{ url('/readCategories') }}" class="{{Request::is('readCategories')?'active':''}}">Categories</a></li>
		  <li><a href="{{ url('/readFolders') }}" class="{{Request::is('readFolders')?'active':''}}">Folders</a></li>
	  	@endif
		<!--<li><a href="{{-- url('/search') --}}">Advanced Search</a></li>-->
		<li>
		  	@if (Auth::check())
		    	<a href="#">
					Logged in as {{{ isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email }}}
		    	</a>  		
		  	@else
		    	<a href="{{ url('/login') }}" class="{{Request::is('login')?'active':''}}">Log In</a>
		  	@endif

		  	@if (Auth::check())
				<ul>
					<li> <a href="{{ url('/logout') }}">Logout</a></li>
				</ul>
			@endif
		</li>
	</ul>
	<a target="_blank" class="fi" href="https://www.facebook.com/pages/Vertical-Booking-USA/1705295629695799?sk=timeline&amp;ref=page_internal">
		<i class="fab fa-facebook-f"></i>
	</a>
	<a target="_blank" class="fi" href="https://twitter.com/VBookingUSA">
		<i class="fab fa-twitter"></i>
	</a>
</div>