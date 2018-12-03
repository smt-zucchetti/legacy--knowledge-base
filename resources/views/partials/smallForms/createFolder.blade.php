<form class="smallForm" method="post" action="{{ url('createFolder') }}">
	@csrf
	<h2>Add New Folder</h2>
	<label for="parentFolder">Parent Folder: 
		@include('partials/foldersSelectBox', ['curFolderId' => null, 'formType' => 'createFolder'])
	</label>
	<label for="name">Name: 
		<input type="text" name="name" id="name" value="{{!empty($curFolder)?$curFolder->name:''}}" />
		<div class="validationError">Folder name can not be blank</div>
	</label>
	<button class="button createBtn" type="submit">Create</button>
</form>