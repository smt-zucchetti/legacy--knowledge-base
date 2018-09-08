@extends('layouts.formMaster', ['bodyId'=>'singleArticle'])

@section('title', 'New User')

@section('main')
	<div class="action-icons">
		<a id="goBack" href="javascript:window.history.back();" >
			<i class="fas fa-reply"></i>
			Back
		</a>


		<div style="display: none;" id="deleteArticleTmp">
			<form method="post" action="<?php echo url('/deleteArticle/'.$article->ID);?>">
				@csrf
				<h2>Delete the Article?</h2>
				<input type="submit" value="Delete" />
				<button class="cancelButton" type="button" data-fancybox-close="" >
					Cancel
				</button>
			</form>
		</div>
		<a id="deleteArticle" data-fancybox data-src="#deleteArticleTmp" href="javascript:;">
			<i class="fas fa-trash-alt"></i> Delete 
		</a>
		


		<a id="editArticle" href="<?php echo url('/updateArticle/'.$article->ID) ?>" >
			<i class="fas fa-pencil-alt"></i>
			Edit
		</a>
	</div>
	<div class="singleArticleBorder">
		<h1 class="title">{{$article->Title}}</h1>
		{!! $article->Content !!}
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