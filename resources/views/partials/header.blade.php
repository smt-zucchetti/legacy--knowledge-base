<header>
	<div class="flexContainer">
			<a class="logo-a" href="http://www.verticalbookingusa.com/"><img class="logo pull-left" id="header-logo" src="http://www.verticalbookingusa.com/images/logo.png"></a>
			


				<ul class="nav">
					  <li><a href="<?php echo url('/readArticles');?>">Articles</a></li>
					  @if (Auth::check())
					    <li><a href="<?php echo url('/readCategories');?>">Categories</a></li>
					  @endif
					  <li>
					      @if (Auth::check())
					        <a href="<?php echo url('/logout'); ?>">Log Out</a>  		
					      @else
					        <a href="<?php echo url('/login'); ?>">Log In</a>
					      @endif
					  </li>
					</ul>
			@if (Auth::check())
				Logged in as {{{ isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email }}}
			@endif
		     
				    <a id="youtube-popup" href="#">
					    <img src="http://www.verticalbookingusa.com/images/video-icon.png"> 
    				    Welcome Video
	                </a>
	
					<a target="_blank" class="fi" href="https://www.facebook.com/pages/Vertical-Booking-USA/1705295629695799?sk=timeline&amp;ref=page_internal">
						<i class="fab fa-facebook-f"></i>
					</a>
					<a target="_blank" class="fi" href="https://twitter.com/VBookingUSA">
						<i class="fab fa-twitter"></i>
					</a>
	
			</div>

	</div>
</header>