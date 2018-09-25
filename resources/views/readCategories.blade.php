@extends('layouts.formMaster',['bodyId'=>'viewCategories'])

@section('title', 'Categories')

@section('main')




<div class="actionItems">
	<div style="display: none;" id="add-category">
		<form method="post" action="<?php echo url('createCategory');?>">
			@csrf
			<h2>Add New Category</h2>
			<div class="catNameError hide">Category Name is empty</div>
			<input type="text" name="name" />
			<input type="submit" value="Create" />
		</form>
	</div>
	<a class="addCategory" data-fancybox data-src="#add-category" href="javascript:;">
		<i class="fas fa-plus"></i> Add New 
	</a>
</div>


<div class="collatedGridHeader categories">
	<div>
		Name
		<span class="sortArrow Name">
			<a href="#" class="upArrow"></a>
			<a href="#" class="downArrow"></a>
		</span>
	</div>
	<div></div>
	<div>
		Date Created
		<span class="sortArrow down dateCreated">
			<a href="#" class="upArrow"></a>
			<a href="#" class="downArrow"></a>
		</span>
	</div>
</div>

<?php $i = 0; ?>

<?php 
 	$sort = $sorted[0] == true?'sorted':'noSort';
 ?>
<div class="collatedGrid categories <?php echo $sort; ?>">
	@foreach($categories as $category)
	<?php $row = ($i % 2 == 0)?"oddRow":""; ?>
	<div class="{{$row}} titleRow">
		{{$category->Name}}
	</div>
	<div class="{{$row}} actionItems">
		<div style="display: none;" id="update-category-{{$category->ID}}">
			<form method="post" action="<?php echo url('/updateCategory/'.$category->ID);?>">
				@csrf
				<h2>Edit Category Name</h2>
				<input type="text" name="name" value="{{$category->Name}}" />
				<input type="submit" value="Edit" />
				<button class="cancelButton" type="button" data-fancybox-close="" >
					Cancel
				</button>
			</form>
		</div>
		<a data-fancybox data-src="#update-category-{{$category->ID}}" href="javascript:;"  >
			<i class="fas fa-pencil-alt"></i>
			Edit
		</a>

		<div style="display: none;" id="delete-category-{{$category->ID}}">
			<form method="post" action="<?php echo url('/deleteCategory/'.$category->ID);?>">
				@csrf
				<h2>Delete Category "{{$category->Name}}"?</h2>
				<input type="submit" value="Delete" />
				<button class="cancelButton" type="button" data-fancybox-close="" >
					Cancel
				</button>
			</form>
		</div>
		<a data-fancybox data-src="#delete-category-{{$category->ID}}" href="javascript:;" >
			<i class="fas fa-trash-alt"></i>
			Delete
		</a>
	</div>
	<div class="{{$row}}">
		{{$category->dateCreated}}
	</div>
	<?php $i++ ?>
@endforeach
</div>

<script>
	$(document).ready(function(){
		@include('partials/javaScriptSort', ['type' => 'categories']  );

		$('#add-category > form').submit(function(){
			if( $(this).find($('input[name=name]')).val() == ""){
				$('.catNameError').show();	

				return false;
			}else{
				return true;
			}
		});

	});
	
</script>

@stop