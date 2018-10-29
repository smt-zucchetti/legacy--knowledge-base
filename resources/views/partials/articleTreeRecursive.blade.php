@if($type == "folders")
	<ul>
		@foreach($folders as $folder)		
			<li class="folderList">
				<a href="#" class="collapseExpandAnchor">
					<i class="far fa-minus-square"></i>
					<i class="far fa-plus-square hide"></i>
				</a>
				@if($folder->id !== NULL)
					@include('partials/folder', ['id' => $folder->id, 'name' => $folder->name])
				@else
					@include('partials/folder', ['id' => null, 'name' => 'Knowledge Base'])
				@endif

				@if(!empty($folder->childFolders) && count($folder->childFolders) > 0)
					@include('partials/articleTreeRecursive', ['folders' => $folder->childFolders, 'type' => 'folders'])
				@endif			
			</li>
		@endforeach
	</ul>
@elseif($type == "files")
	@foreach($folders as $folder)
		@php($hasContents = false)
		<li class="fileList {{$folder->id == null?'selected':''}}" data-id="{{$folder->id == null?'null':$folder->id}}">
			<ul>
				@foreach($folder->childFolders as $childFolder)
					<li>
						@include('partials/folder', ['id' => $childFolder->id, 'name' => $childFolder->name])
					</li>
					@php($hasContents = true)
				@endforeach
				@foreach($folder->articlesArr as $articleId => $articleTitle)
					<li>
						<a href="readArticle/{{$articleId}}">
							<i class="far fa-file"></i>
							<span class="itemTitle">{{$articleTitle}}</span>
						</a>
					</li>
					@php($hasContents = true)
				@endforeach
				@if(!$hasContents)
					<li>No Contents</li>
				@endif
			</ul>			
		</li>
		@if(!empty($folder->childFolders) && count($folder->childFolders) > 0)
			@include('partials/articleTreeRecursive', ['folders' => $folder->childFolders, 'type' => 'files'])
		@endif
	@endforeach
@endif