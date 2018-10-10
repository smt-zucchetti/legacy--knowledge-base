<div class="articleTree">
<ul>
	@foreach($folders as $folder)
		<li class="fileOrFolder" data-id="{{$folder->id}}">
			<a href="#" class="collapseExpandAnchor">
				<i class="far fa-minus-square"></i>
				<i class="far fa-plus-square"></i>
			</a>
			<i class="fas fa-folder"></i>
			<span class="itemTitle">{{$folder->folderName}}</span>
			
			@if(!empty($folder->childFolders) && count($folder->childFolders) > 0)
				@include('partials/articleTree', ['folders' => $folder->childFolders])
			@endif

			<?php
				$articleTitlesArr = ($folder->articleTitles !== null)?explode(",", $folder->articleTitles):array();
				$articleIdsArr = ($folder->articleIds !== null)?explode(",", $folder->articleIds):array();
			?>
			<ul>
				@for($i = 0; $i < count($articleTitlesArr); $i++)
					<li class="fileOrFolder" data-id="{{$articleIdsArr[$i]}}">
						<i class="far fa-file"></i>
						<span class="itemTitle">{{$articleTitlesArr[$i]}}</span>
					</li>
				@endfor
			</ul>
		</li>

	@endforeach
</ul>
</div>

<script>
	$(document).ready(function(){
		$('.collapseExpandAnchor').click(function(){
			$(this).closest('li.fileOrFolder').find('ul').toggle();
			$(this).find('.fa-minus-square').toggle();
			$(this).find('.fa-plus-square').toggle();
		});
	});
</script>