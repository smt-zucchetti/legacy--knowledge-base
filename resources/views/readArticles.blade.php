@extends('layouts.formMaster', ['bodyId'=>'listArticles'])

@section('title', 'New User')

@section('main')


<a class="addArticle" href="<?php echo url('/createArticle') ?>">
	<i class="fas fa-plus"></i> Add New 
</a>
<div class="collatedGridHeader">
	<div>
		Title
		<span class="sortArrow">
			<i class="fas fa-sort-up active"></i>
			<i class="fas fa-sort-down"></i>
		</span>
	</div>
	<div>Actions</div>
	<div class="categoryMenuItem">Category</div>
	<div class="dateCreatedMenuItem">Date Created</div>
</div>
 <?php 
 	if(empty($sort)){
 		$sort = 'noSort';
 	}
 ?>
<div class="collatedGrid <?php echo $sort; ?>">
	<?php $i = 0; ?>
	@foreach($articles as $article)
		<?php $row = ($i % 2 == 0)?"row":""; ?>

		<div class="{{$row}}">
			<a href="<?php echo url('/readArticle/'.$article->ID);?>">
				{{$article->Title}}
			</a>
		</div>
		<div class="{{$row}} actionItems">
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
			<a href="<?php echo url('/updateArticle/'.$article->ID) ?>" >
				<i class="fas fa-pencil-alt"></i>
				Edit
			</a>
		</div>
		<div class="{{$row}}">
			<ul class="categories">
				<?php 
					$x = 0;
					foreach($article->CategoryArr as $catArr){						 
						echo "<li class='category'>";
						echo 	$catArr['name']; 
						echo (count($article->CategoryArr) > 1 && $x == 0)?'<a class="seeMore" href="#"></a>':'';
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

		$('.sortArrow').click(function(e){
			$(this).find('.fa-sort-up').toggleClass('active');
			$(this).find('.fa-sort-down').toggleClass('active');
		});

		$('.sortArrow').click(function(e){

			$.ajax({
	         	url : "{{URL::action('ArticleController@sortArticles')}}",
	          	type : "GET",
	          	//data : {action: 'refresh'}

		        success: function(response){
		            $('.collatedGrid.noSort').empty();
		            $(response).find('.collatedGrid.sorted > *').appendTo('.collatedGrid.noSort');		            
	        	},
	    	});
		});
	});	
</script>
@stop
