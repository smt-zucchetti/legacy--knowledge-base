@extends('layouts.mainLayout',['bodyId'=>'viewCategories'])

@section('title', 'Categories')

@section('main')


@include('partials/actionItems', ['items' => array('addCategory')])


@include('partials/listHeader', ['type' => 'categories'])


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

@include('partials/javaScriptSort')

<script>
	$(document).ready(function(){

		$('#addCategory > form').submit(function(){
			if( $(this).find('input[name=name]').val() == ""){
				$('.validationError').removeClass('hidden');	

				return false;
			}else{
				return true;
			}
		});

	});
	
</script>

@stop