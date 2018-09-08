<ul>
  <li><a href="<?php echo url('/readArticles');?>">Articles</a></li>
  <li><a href="<?php echo url('/readCategories');?>">Categories</a></li>
  <li>
      <form method="post" action="<?php echo url('/searchArticles') ?>" >
         @csrf
        Search: <input type="text" name="search" />
        <input type="submit" value="Search" />
      </form>
  </li>
</ul>