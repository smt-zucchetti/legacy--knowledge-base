@extends('layouts.formMaster')

@section('title', 'New User')

@section('main')
	<div class="actionItems">
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
			<a data-fancybox data-src="#deleteArticleTmp" href="javascript:;">
				<i class="fas fa-trash-alt"></i> Delete 
			</a>
			<a id="editArticle" href="<?php echo url('/updateArticle/'.$article->ID) ?>" >
				<i class="fas fa-pencil-alt"></i>
				Edit
			</a>
		@endif
	</div>

	<div class="articleContainer">

		<div class="metaDataContainer">
			<h3 class="title">Title: <span class="answer">{{$article->Title}}</span></h3>
			<div class="singleArticleDetails">
		    	<div class="item">
			    	<h3>Featured? <span class="answer"><?php echo !empty($article->featured)?"Yes":"No"; ?></span></h3> 
				</div>
				<div class="item categories">
					<h3>Categories:</h3>
					<ul class="categoryList">
						<?php
							if(!empty($article->categoryNames)){
								foreach(explode(",",$article->categoryNames) as $categoryName){						 
									echo "<li class='category'>";
									echo 	$categoryName; 
									echo "</li>";
								}
							}else{
								echo "no categories selected"; 
							}
						?>
					</ul>
				</div>
			</div>
		</div>

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