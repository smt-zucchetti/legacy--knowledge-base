@foreach($folders as $folder)
	<option value="{{$folder->id}}" 
		{{ !empty($curFolder) && $curFolder->parentId === $folder->id?"selected":""}}  
		{{ !empty($curFolder) && $curFolder->id === $folder->id?"disabled":""}}
	> 
		{{str_repeat("---", $folder->depth)}} {{$folder->name}}
	</option>

	@include('partials/printChildFolders', ['folders' => $folder->childFolderObjsArr])
		
@endforeach