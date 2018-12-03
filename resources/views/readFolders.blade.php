@extends('layouts.mainLayout')

@section('title', 'Folders')

@section('main')

<div class="actionItems actionItemsHeader">
	@include('partials/actionItems', ['items' => [['createFolder', 'Add New']], 'objId' => null])
</div>


@include('partials/listHeader', ['type' => 'folders'])
@php($i = 0)
<div class="collatedGrid folders">
	@foreach($foldersScalar as $folder)
		@php($row = ($i % 2 == 0)?"row odd":"row" )
		<div class="{{$row}} titleRow">
			{{$folder->name}}
		</div>
		<div class="{{$row}}">
			{{$folder->dateCreated}}
		</div>
		<div class="{{$row}} actionItems">
			@include('partials/actionItems', ['items' => [['updateFolder', 'Update'], ['deleteFolder', 'Delete']], 'objId' => $folder->id])
		</div>
		@php($i++)
	@endforeach
</div>

@include('partials/javaScriptSort')

<script>
	$(document).ready(function(){

		$('form.smallForm').submit(function(e){
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