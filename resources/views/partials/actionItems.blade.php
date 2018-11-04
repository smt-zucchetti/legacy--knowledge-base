<div class="actionItems actionItemsHeader">
	@if(in_array('back', $items))
		<a id="goBack" href="javascript:window.history.back();" >
			<i class="fas fa-reply"></i>
			Back
		</a>
	@endif

	@if(in_array('deleteArticle', $items) && Auth::check())
		<div style="display: none;" id="deleteArticleTmp">
			<form method="post" action="{{ url('deleteArticle/'.$article->ID) }}">
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
	@endif

	@if(in_array('editArticle', $items) && Auth::check())
		<a id="editArticle" href="{{ url('/updateArticle/'.$article->ID) }}" >
			<i class="fas fa-pencil-alt"></i>
			Edit
		</a>
	@endif

	@if(in_array('addCategory', $items) && Auth::check())
		<div style="display: none;" id="addCategory">
			<form method="post" action="{{ url('createCategory') }}">
				@csrf
				<h2>Add New Category</h2>
				<div class="validationError hidden">Category Name is empty</div>
				<input type="text" name="name" />
				<input type="submit" value="Create" />
			</form>
		</div>
		<a class="addCategory" data-fancybox data-src="#addCategory" href="javascript:;">
			<i class="fas fa-plus"></i> Add New 
		</a>
	@endif


	@if(in_array('addFolder', $items) && Auth::check())
		<div style="display: none;" id="addFolder">
			<form method="post" action="<?php echo url('createFolder');?>">
				@csrf
				<h2>Add New Folder</h2>
				@include('partials/foldersSelectBox', ['curFolderId' => null, 'formType' => 'createFolder'])
				<label for="name">Name
					<input type="text" name="name" id="name" value="{{!empty($curFolder)?$curFolder->name:''}}" />
				</label>
				<input type="submit" value="Create" />
			</form>
		</div>
		<a class="addFolder" data-fancybox data-src="#addFolder" href="javascript:;">
			<i class="fas fa-plus"></i> Add New 
		</a>
	@endif


</div>