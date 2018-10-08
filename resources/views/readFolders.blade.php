@extends('layouts.formMaster')

@section('title', 'Folders')

@section('main')




<div class="actionItems">
	<div style="display: none;" id="addFolder">
		<form method="post" action="<?php echo url('createFolder');?>">
			@csrf
			<h2>Add New Folder</h2>
			@include('partials/folderFormFields')
			<input type="submit" value="Create" />
		</form>
	</div>
	<a class="addFolder" data-fancybox data-src="#addFolder" href="javascript:;">
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
	@foreach($folders as $folder)
		<?php $row = ($i % 2 == 0)?"oddRow":""; ?>
		<div class="{{$row}} titleRow">
			{{$folder->name}}
		</div>
		<div class="{{$row}} actionItems">
			<div style="display: none;" id="updateFolder-{{$folder->id}}">
				<form method="post" action="<?php echo url('/updateFolder/'.$folder->id);?>">
					@csrf
					<h2>Edit Folder Name</h2>
					@include('partials/folderFormFields', ['curFolder' => $folder])
					<input type="submit" value="Edit" />
					<button class="cancelButton" type="button" data-fancybox-close="" >
						Cancel
					</button>
				</form>
			</div>
			<a data-fancybox data-src="#updateFolder-{{$folder->id}}" href="javascript:;"  >
				<i class="fas fa-pencil-alt"></i>
				Edit
			</a>

			<div style="display: none;" id="deleteFolder-{{$folder->id}}">
				<form method="post" action="<?php echo url('/deleteFolder/'.$folder->id);?>">
					@csrf
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