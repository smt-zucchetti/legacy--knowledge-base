@extends('layouts.formMaster')

@section('title', 'Dashboard')

@section('main')

@if (Auth::check())
	<div class="actionItems">
		<a class="addArticle" href="<?php echo url('/createArticle') ?>">
			<i class="fas fa-plus"></i> Add New 
		</a>
	</div>
@endif

<div class="smallSearchForm">
	<form method="post" action="<?php echo url('/searchArticles') ?>" >
	   @csrf
	  Search: <input type="text" name="search" value="<?php echo !empty($searchTerm)?$searchTerm:''; ?>" />
	  <input type="submit" value="Search" />
	</form>
	<a class="advSearch" href="<?php echo url('/search') ?>">Advanced Search</a>
</div>

@if (!empty($featuredArticles))
	@include('partials/featuredArticles', ['articles' => $articles ] )
@endif



@include('partials/articleList', ['articles' => $articles])




<script>
	$(document).ready(function(){

		$('.collatedGrid').on('click', 'a.seeMore', function(e){
			e.preventDefault();
			
			$(this).closest('ul.categories').toggleClass('showAll');
		});

		@include('partials/javaScriptSort', ['type' => 'articles'] );

	});	
</script>
@stop
