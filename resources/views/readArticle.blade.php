@extends('layouts.mainLayout', ['bodyId'=>'singleArticle'])

@section('title', 'New User')

@section('main')

	@include('partials/actionItems', ['items' => array('back', 'deleteArticle', 'editArticle')])

	<div class="articleContainer">

		
		@if(!empty($article->categoryNames))
			<h3>Categories:</h3>
			<ul>
				@foreach(explode(",",$article->categoryNames) as $categoryName)						 
					<li class='category'>{{$categoryName}}</li>
				@endforeach
			</ul>
		@endif
		<h3 class="title">{{$article->Title}}</h3>
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