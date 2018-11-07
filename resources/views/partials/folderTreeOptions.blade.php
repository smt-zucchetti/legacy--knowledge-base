@foreach($folderTree as $folder)
	<option value="{{$folder->id}}"
		@if($formType == "createFolder")
			{{ !empty($curFolder) && $curFolder->parentId === $folder->id?"selected":""}}
			{{ !empty($curFolder) && $curFolder->id === $folder->id?"disabled":""}}
		@elseif($formType == "updateFolder")
			{{ !empty($curFolder) && $curFolder->parentId === $folder->id?"selected":""}}
			{{ !empty($curFolder) && $curFolder->id === $folder->id?"disabled":""}}
			{{ !empty($curFolder) && in_array($folder->id, array_keys($curFolder->descendantFoldersArr))?"disabled":""}}
		@elseif($formType == "updateArticle")
			{{ !empty($curFolder) && $curFolder->id === $folder->id?"selected":""}}
		@endif
	> 
		{{str_repeat("---", $folder->depth - 1)}} 
		{{!empty($folder->name)?$folder->name:"Knowledge Base Root"}}
		@if($formType !== "updateFolder")
			{{ !empty($curFolder) && $curFolder->id === $folder->id?"(current)":""}}
		@elseif($formType == "updateFolder" || $formType == "createFolder")
			{{ !empty($curFolder) && $curFolder->parentId === $folder->id?"(parent)":""}}
		@endif
	</option>

	@include('partials/folderTreeOptions', ['folderTree' => $folder->childFolderObjsArr])
		
@endforeach