@extends('layouts.mainLayout')

@section('title', 'Folders')

@section('main')

@include('partials/actionItems', ['items' => array('addFolder')])
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
			<div style="display: none;" id="updateFolder-{{$folder->id}}">
				@include('partials/smallForms/updateFolder')
			</div>
			<a data-fancybox data-src="#updateFolder-{{$folder->id}}" href="javascript:;"  >
				<i class="fas fa-pencil-alt"></i>
			</a>
			<div style="display: none;" id="deleteFolder-{{$folder->id}}">
				@include('partials/smallForms/deleteFolder')
			</div>
			<a data-fancybox data-src="#deleteFolder-{{$folder->id}}" href="javascript:;" >
				<i class="fas fa-trash-alt"></i>
			</a>
		</div>
		@php($i++)
	@endforeach
</div>

@include('partials/javaScriptSort')

<script>
	$(document).ready(function(){

		$('form.updateFolder').submit(function(e){
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