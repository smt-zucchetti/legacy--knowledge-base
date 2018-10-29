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

@include('partials/searchForm')

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
	});	
</script>
@stop
