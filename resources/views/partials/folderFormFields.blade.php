<label for="parentId">Parent Folder {{!empty($curFolder)?$curFolder->parentId:""}}</label>
<select id="parentId" name="parentId">
	<option value="" selected>None (top-level folder)</option>
	@foreach($folderHierarchy as $folder)
		<option value="{{$folder->id}}" {{!empty($curFolder) && $curFolder->parentId === $folder->id?"selected":""}}>- {{$folder->name}}</option>
		
		@include('partials/printChildFolders', ['node' => $folder, 'prefix' => '- -' ])
		
	@endforeach
</select><br><br>
<label for="name">Name
	<input type="text" name="name" id="name" value="{{!empty($curFolder)?$curFolder->name:''}}" />
</label>