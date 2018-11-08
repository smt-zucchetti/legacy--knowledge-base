<form class="smallForm" method="post" action="{{ url('/deleteFolder/'.$folder->id) }}">
	
	@csrf

	@if(!empty($folder->articlesArr) || !empty($folder->childFolderObjsArr))
		<h2>Can't Delete Folder</h2>
		<span>Folder "{{$folder->name}}" cannot be deleted, as it contains one or more articles and/or folders.<br> 
		Please delete or move the articles/folders and try again.</span>
		<br><br>
		@if(!empty($folder->articlesArr)) 
			<span><b>Articles:</b> {{implode(", ", $folder->articlesArr) }}</span>
		@endif
		<br>
		@if(!empty($folder->childFolderObjsArr))
			<span><b>Folders:</b> {{implode(", ", array_map(function($childFolder){return $childFolder->name;}, $folder->childFolderObjsArr))}}</span>
		@endif
	@else
		<h2>Delete Folder "{{$folder->name}}"?</h2>
		@include('partials/smallForms/buttons/deleteBtn')
	@endif
	
	@include('partials/smallForms/buttons/cancelBtn')
</form>