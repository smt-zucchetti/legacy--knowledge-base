@if($type == "folders")
	<ul class="folderList">
		@foreach($folders as $folder)		
			<li class="objectListItem isFolder">
				<div class="nodeContainer">
					<a href="#" class="collapseExpandAnchor">
						<i class="far fa-minus-square"></i>
						<i class="far fa-plus-square hide"></i>
					</a>
					@if($folder->id === null)
						@include('partials/html/folder', ['id' => null, 'name' => 'Knowledge Base'])
					@else
						@include('partials/html/folder', ['id' => $folder->id, 'name' => $folder->name])	
					@endif
				</div>

				@if(count($folder->childFolderObjsArr) > 0)
					@include('partials/articleTreeRecursive', ['folders' => $folder->childFolderObjsArr, 'type' => 'folders'])
				@endif			
			</li>
		@endforeach
	</ul>
@elseif($type == "files")
	@foreach($folders as $folder)
		<li class="contentsList {{$folder->id === null?'shown':''}}" data-id="{{$folder->id === null?'null':$folder->id}}">
			<ul>
				@foreach($folder->childFolderObjsArr as $childFolder)
					<li class="objectListItem isFolder">
						@include('partials/html/folder', ['id' => $childFolder->id, 'name' => $childFolder->name])
					</li>
				@endforeach
				@foreach($folder->articlesArr as $id => $title)
					<li class="objectListItem isFile">
						@include('partials/html/file', ['id' => $id, 'title' => $title])
					</li>
				@endforeach
				@if(count($folder->childFolderObjsArr) === 0 && count($folder->articlesArr) === 0)
					<li>No Contents</li>
				@endif
			</ul>			
		</li>
		@if(count($folder->childFolderObjsArr) > 0)
			@include('partials/articleTreeRecursive', ['folders' => $folder->childFolderObjsArr, 'type' => 'files'])
		@endif
	@endforeach
@endif