<form class="smallSearchForm" method="post" action="<?php echo url('/searchArticles') ?>" >
   @csrf
  <input placeholder="Search for article by title or content" type="text" name="search" value="<?php echo !empty($searchTerm)?$searchTerm:''; ?>" />
  <input type="submit" value="Search" />
</form>
<!--<a class="advSearch" href="<?php echo url('/search') ?>">Advanced Search</a>-->
<div class="clear"></div>