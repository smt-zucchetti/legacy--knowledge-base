@extends('layouts.mainLayout', ['bodyId'=>'singleArticle'])

@section('title', 'New User')

@section('main')

	@include('partials/actionItems', ['items' => array('back', 'deleteArticle', 'editArticle')])

	<div class="articleContainer">

		<div>
			<h3>Categories:</h3>
			<?php
				foreach(explode(",",$article->categoryNames) as $categoryName){						 
					echo "<li class='category'>";
					echo 	$categoryName; 
					echo "</li>";
				}
			?>
		</div>
		<h3 class="title">Title: {{$article->Title}}</h3>
		<div class="singleArticleBorder">
			{!! $article->Content !!}
		</div>
	</div>

	<script>
		$('#deleteArticle').click(function(e){
	
			e.preventDefault();
		});

		$('.seeMore').click(function(e){
			e.preventDefault();
			

		});
	</script>

@stop