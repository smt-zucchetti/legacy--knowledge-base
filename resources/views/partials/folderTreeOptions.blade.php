@foreach($folders as $folder)
	<option value="{{$folder->id}}" 
		{{ !empty($curFolder) && $curFolder->parentId === $folder->id?"selected":""}}  
		{{ !empty($curFolder) && $curFolder->id === $folder->id?"disabled":""}}
		{{ !empty($curFolder) && in_array($folder->id, $curFolder->childIds)?"disabled":""}}
	> 
		{{str_repeat("---", $folder->depth)}} {{$folder->name}}
	</option>

	@include('partials/folderTreeOptions', ['folders' => $folder->childFolders])
		
@endforeach