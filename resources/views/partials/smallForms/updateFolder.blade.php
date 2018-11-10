<form class="smallForm" method="post" action="{{ url('updateFolder/'.$folder->id) }}">
	
	@csrf
	<h2>Edit Folder "{{$folder->name}}"</h2>

	<label for="parentFolder">Parent Folder: 
		@include('partials/foldersSelectBox', ['curFolder' => $folder, 'formType' => 'updateFolder'])
	</label>
	<label for="name">Name:
		<input type="text" name="name" id="name" value="{{$folder->name}}" />
		<div class="validationError">Folder name can not be blank</div>
	</label>

	@include('partials/smallForms/buttons/updateBtn')
	@include('partials/smallForms/buttons/cancelBtn')
</form>