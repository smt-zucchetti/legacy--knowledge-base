<ul>
  <li><a href="<?php echo url('/readArticles');?>">Articles</a></li>
  @if (Auth::check())
    <li><a href="<?php echo url('/readCategories');?>">Categories</a></li>
  @endif
  <li>
      <form method="post" action="<?php echo url('/searchArticles') ?>" >
         @csrf
        Search: <input type="text" name="search" />
        <input type="submit" value="Search" />
      </form>
  </li>
  <li>
      @if (Auth::check())
        Logged in as {{{ isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email }}}
        <a href="<?php echo url('/logout'); ?>">Log Out</a>  		
      @else
        <a href="<?php echo url('/login'); ?>">Log In</a>
      @endif
  </li>
</ul>