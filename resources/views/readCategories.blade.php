@extends('layouts.mainLayout',['bodyId'=>'viewCategories'])

@section('title', 'Categories')

@section('main')

@include('partials/actionItems', ['items' => array('addCategory')])

@include('partials/listHeader', ['type' => 'categories'])

@php($i = 0)

<div class="collatedGrid categories">
	@foreach($categories as $category)
		@php($row = ($i % 2 == 0)?"row odd":"row")
		<div class="row {{$row}} titleRow">
			{{$category->Name}}
		</div>
		<div class="{{$row}}">
			{{$category->dateCreated}}
		</div>
		<div class="{{$row}} actionItems">
			<div style="display: none;" id="updateCategory-{{$category->ID}}">
				@include('partials/smallForms/updateCategory')
			</div>
			<a data-fancybox data-src="#updateCategory-{{$category->ID}}" href="javascript:;"  >
				<i class="fas fa-pencil-alt"></i>
			</a>

			<div style="display: none;" id="deleteCategory-{{$category->ID}}">
				@include('partials/smallForms/deleteCategory')
			</div>
			<a data-fancybox data-src="#deleteCategory-{{$category->ID}}" href="javascript:;" >
				<i class="fas fa-trash-alt"></i>
			</a>
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