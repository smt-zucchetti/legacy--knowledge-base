@if($type == "folders")
	<ul>
		@foreach($folders as $folder)		
			<li class="folderList">
				<a href="#" class="collapseExpandAnchor">
					<i class="far fa-minus-square"></i>
					<i class="far fa-plus-square hide"></i>
				</a>
				@if($folder->id === null)
					@include('partials/folder', ['id' => null, 'name' => 'Knowledge Base'])
				@else
					@include('partials/folder', ['id' => $folder->id, 'name' => $folder->name])					
				@endif

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
					<li>
						@include('partials/folder', ['id' => $childFolder->id, 'name' => $childFolder->name])
					</li>
				@endforeach
				@foreach($folder->articlesArr as $articleId => $articleTitle)
					<li>
						<a href="readArticle/{{$articleId}}" class="file">
							<i class="far fa-file"></i>
							<span class="itemTitle">{{$articleTitle}}</span>
						</a>
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