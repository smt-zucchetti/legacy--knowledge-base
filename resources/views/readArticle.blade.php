@extends('layouts.formMaster', ['bodyId'=>'singleArticle'])

@section('title', 'New User')

@section('main')
	<div class="action-icons">
		<a id="goBack" href="javascript:window.history.back();" >
			<i class="fas fa-reply"></i>
			Back
		</a>
		@if (Auth::check())
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
		@endif
	</div>
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

	<script>
		$('#deleteArticle').click(function(e){
	
			e.preventDefault();
		});

		$('.seeMore').click(function(e){
			e.preventDefault();
			

		});
	</script>

@stop