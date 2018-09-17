@extends('layouts.formMaster', ['bodyId'=>'listArticles'])

@section('title', 'New User')

@section('main')

@if (Auth::check())
	<a class="addArticle" href="<?php echo url('/createArticle') ?>">
		<i class="fas fa-plus"></i> Add New 
	</a>
@endif

@if (Auth::check())
	<div class="collatedGridHeader loggedIn">
@else
	<div class="collatedGridHeader">
@endif

	<div>
		Title 
 		<span class="sortArrow Title">
			<a href="#" class="upArrow"></a>
			<a href="#" class="downArrow"></a>
		</span>
	</div>
	@if (Auth::check())
		<div>Actions</div>
	@endif
	<div class="categoryMenuItem">
		Category
		<span class="sortArrow categoryNames">
			<a href="#" class="upArrow"></a>
			<a href="#" class="downArrow"></a>
		</span>
	</div>
	<div class="dateCreatedMenuItem">
		Date Created
		<span class="sortArrow down dateCreated">
			<a href="#" class="upArrow"></a>
			<a href="#" class="downArrow"></a>
		</span>
	</div>
</div>
 <?php 
 	if(empty($sort)){
 		$sort = 'noSort';
 	}
 ?>

@if (Auth::check())
	<div class="collatedGrid <?php echo $sort; ?> loggedIn">
@else
 	<div class="collatedGrid <?php echo $sort; ?>">
@endif
	<?php $i = 0; ?>
	@foreach($articles as $article)
		<?php $row = ($i % 2 == 0)?"row":""; ?>

		<div class="{{$row}}">
			<a href="<?php echo url('/readArticle/'.$article->ID);?>">
				{{$article->Title}}
			</a>
		</div>
		@if (Auth::check())
		<div class="{{$row}} actionItems">
			<div style="display: none;" id="delete-article-{{$article->ID}}">
				<form method="post" action="<?php echo url('/deleteArticle/'.$article->ID);?>">
					@csrf
					<h2>Delete Article "{{$article->Title}}"?</h2>
					<input type="submit" value="Delete" />
					<button class="cancelButton" type="button" data-fancybox-close="" >
						Cancel
					</button>
				</form>
			</div>
			<a data-fancybox data-src="#delete-article-{{$article->ID}}" href="javascript:;">
				<i class="fas fa-trash-alt"></i> Delete 
			</a>
			<a href="<?php echo url('/updateArticle/'.$article->ID) ?>" >
				<i class="fas fa-pencil-alt"></i>
				Edit
			</a>
		</div>
		@endif
		<div class="{{$row}}">
			<ul class="categories">
				<?php 
					$x = 0;
					foreach(explode(",",$article->categoryNames) as $categoryName){						 
						echo "<li class='category'>";
						echo 	$categoryName; 
						echo (count(explode(",",$article->categoryNames)) > 1 && $x == 0)?'<a class="seeMore" href="#"></a>':'';
						echo "</li>";

						$x++;
					}
			
				?>
			</ul>
		</div>
		<div class="{{$row}}">
			{{$article->dateCreated}}
		</div>
		<?php $i++ ?>
	@endforeach
</div>


<script>
	$(document).ready(function(){

		$('a.seeMore').click(function(e){
			e.preventDefault();
			
			$(this).closest('ul.categories').toggleClass('showAll');
		});

		@include('partials/javaScriptSort', ['type' => 'articles'] );

	});	
</script>
@stop
