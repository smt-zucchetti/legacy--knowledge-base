<form class="smallSearchForm" method="get" action="{{ url('/searchArticles') }}" >
   @csrf

	<input placeholder="Search for article by title or content" type="text" name="search" value="{{ !empty($srchTrm)?$srchTrm:'' }}" />
  <button class="button updateBtn" type="submit">Search</button>
</form>
<!--<a class="advSearch" href="<?php echo url('/search') ?>">Advanced Search</a>-->
<div class="clear"></div>