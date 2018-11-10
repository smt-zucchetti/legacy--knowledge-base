@extends('layouts.mainLayout',['bodyId'=>'viewCategories'])

@section('title', 'Categories')

@section('main')

<div class="actionItems actionItemsHeader">
	@include('partials/actionItems', ['items' => [['createCategory', 'Add New']], 'objId' => null])
</div>

@include('partials/listHeader', ['type' => 'categories'])

@php($i = 0)

<div class="collatedGrid categories">
	@foreach($categories as $category)
		@php($row = ($i % 2 == 0)?"row odd":"row")
		<div class="row {{$row}} titleRow">
			{{$category->name}}
		</div>
		<div class="{{$row}}">
			{{$category->dateCreated}}
		</div>
		<div class="{{$row}} actionItems">
			@include('partials/actionItems', ['items' => [['updateCategory', 'Update'], ['deleteCategory', 'Delete']], 'objId' => $category->id])			
		</div>
		@php($i++)
	@endforeach
</div>

@include('partials/javaScriptSort')

<script>
	$(document).ready(function(){

		$('form.updateCategory').submit(function(e){
			if( $(this).find('input[name=name]').val() === ""){
				$('.validationError').addClass('visible');	

				return false;
			}else{
				return true;
			}
		});

	});
	
</script>

@stop