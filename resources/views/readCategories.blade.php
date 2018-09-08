@extends('layouts.formMaster',['bodyId'=>'viewCategories'])

@section('title', 'New User')

@section('main')





<div style="display: none;" id="add-category">
	<form method="post" action="<?php echo url('createCategory');?>">
		@csrf
		<h2>Add New Category</h2>
		<input type="text" name="name" />
		<input type="submit" value="Create" />
	</form>
</div>
<a class="addCategory" data-fancybox data-src="#add-category" href="javascript:;">
	<i class="fas fa-plus"></i> Add New 
</a>

<div class="collatedGridHeader categories">
	<div>Name</div>
	<div></div>
	<div>Date Created</div>
</div>

<?php $i = 0; ?>
<div class="collatedGrid categories">
	@foreach($categories as $category)
	<?php $row = ($i % 2 == 0)?"row":""; ?>
	<div class="{{$row}}">{{$category->Name}}</div>
	<div class="{{$row}} actionItems">
		<div style="display: none;" id="update-category-{{$category->ID}}">
			<form method="post" action="<?php echo url('/updateCategory/'.$category->ID);?>">
				@csrf
				<h2>Edit the Category Name Below</h2>
				<input type="text" name="name" />
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
				<h2>Are You Sure You Want to Delete This Category?</h2>
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

</script>

@stop