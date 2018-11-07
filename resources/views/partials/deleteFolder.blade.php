
<form method="post" action="{{url('/deleteFolder/'.$folder->id) }}">
	@csrf
	@if(!empty($folder->articlesArr) || !empty($folder->childFolderObjsArr))
		<p>Folder "{{$folder->name}}" cannot be deleted, as it contains one or more articles and/or folders.<br> 
		Please delete or move the articles/folders and try again.</p>
		@if(!empty($folder->articlesArr)) 
			<p><b>Articles:</b> {{implode(", ", $folder->articlesArr) }}</p>
		@endif
		@if(!empty($folder->childFolderObjsArr))
			<p><b>Folders:</b> {{implode(", ", array_map(function($childFolder){return $childFolder->name;}, $folder->childFolderObjsArr))}}</p>
		@endif
		

	@else
		<h2>Delete Folder "{{$folder->name}}"?</h2>
		<input type="submit" value="Delete" />
	@endif
	<button class="cancelButton" type="button" data-fancybox-close="" >Cancel</button>
</form>