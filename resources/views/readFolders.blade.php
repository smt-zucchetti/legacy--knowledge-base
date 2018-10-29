@extends('layouts.mainLayout')

@section('title', 'Folders')

@section('main')


@include('partials/actionItems', ['items' => array('addFolder')])


@include('partials/listHeader', ['type' => 'folders'])



@php($i = 0)
<div class="collatedGrid categories {{ $sorted[0] == true?'sorted':'noSort' }}">
	@foreach($folders as $folder)
		@php($row = ($i % 2 == 0)?"oddRow":"" )
		<div class="{{$row}} titleRow">
			{{$folder->name}}
		</div>
		<div class="{{$row}} actionItems">
			<div style="display: none;" id="updateFolder-{{$folder->id}}">
				<form method="post" action="{{ url('updateFolder/'.$folder->id) }}">
					@csrf
					<h2>Edit Folder Name</h2>
					@include('partials/foldersSelectBox', ['curFolder' => $folder])
					<label for="name">Name
						<input type="text" name="name" id="name" value="{{$folder->name}}" />
					</label>
					<input type="submit" value="Edit" />
					<button class="cancelButton" type="button" data-fancybox-close="" >
						Cancel
					</button>
				</form>
			</div>
			<a data-fancybox data-src="#updateFolder-{{$folder->id}}" href="javascript:;"  >
				<i class="fas fa-pencil-alt"></i>Edit
			</a>

			<div style="display: none;" id="deleteFolder-{{$folder->id}}">
				<form method="post" action="<?php echo url('/deleteFolder/'.$folder->id);?>">
					@csrf
					<p>Are you sure you want to delete this folder? It contains the following folders: <?php print_r($folder->childIds); ?></p>
					<h2>Delete Folder "{{$folder->name}}"?</h2>
					<input type="submit" value="Delete" />
					<button class="cancelButton" type="button" data-fancybox-close="" >
						Cancel
					</button>
				</form>
			</div>
			<a data-fancybox data-src="#deleteFolder-{{$folder->id}}" href="javascript:;" >
				<i class="fas fa-trash-alt"></i>
				Delete
			</a>
		</div>
		<div class="{{$row}}">
			{{$folder->dateCreated}}
		</div>
		@php($i++)
	@endforeach
</div>

@include('partials/javaScriptSort')

<script>
	$(document).ready(function(){

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