<header>
	<div class="flexContainer">
			<a class="logo-a" href="<?php echo url('/') ?>"><img class="logo pull-left" id="header-logo" src="http://www.verticalbookingusa.com/images/logo.png"></a>
			


				<ul class="nav">
					  <li>
					  		<a href="<?php echo url('/allArticles');?>">Articles</a>
					  		<ul>
								<!--<li>
									 <a href="<?php echo url('/articleTree'); ?>">Featured Articles</a>
								</li>-->
								<li>
									 <a href="<?php echo url('/articleGUI'); ?>">Article GUI</a>
								</li>
							</ul>
					  </li>
					  @if (Auth::check())
					    <li><a href="<?php echo url('/readCategories');?>">Categories</a></li>

					    <li><a href="<?php echo url('/readFolders');?>">Folders</a></li>
					  @endif
					  <li><a href="<?php echo url('/search');?>">Advanced Search</a></li>
					  <li>
					      @if (Auth::check())
					        <a href="#">
					        	Logged in as {{{ isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email }}}
					        </a>  		
					      @else
					        <a href="<?php echo url('/login'); ?>">Log In</a>
					      @endif

					      @if (Auth::check())
					  		<ul>
								<li>
									 <a href="<?php echo url('/logout'); ?>">Logout</a>
								</li>
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

	</div>
</header>