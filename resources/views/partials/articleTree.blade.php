<div class="articleTree">
	<div class="foldersWrapper">
		@include('partials/articleTreeRecursive', ['folders' => $folders, 'type' => 'folders'])
	</div>
	<div class="filesWrapper">
		<ul>
			@include('partials/articleTreeRecursive', ['folders' => $folders, 'type' => 'files'])
		</ul>
	</div>
</div>
<script>
	$(document).ready(function(){

		$('.collapseExpandAnchor').click(function(e){
			e.preventDefault();

			$(this).closest('.nodeContainer').next('.folderList').toggleClass('hide');
			$(this).find('.fa-minus-square, .fa-plus-square').toggleClass('hide');
			$(this).find('.folder').toggleClass('selected');
		});

		$('.objectAnchor').click(function(e){
			e.preventDefault();

			if($(e.target).parents('.foldersWrapper').length > 0){
				showContentsInFileWrapper($(this).data('id'));
				$('.objectAnchor').removeClass('selected');
			}

			$('.filesWrapper .objectAnchor').removeClass('selected');
			
			$(this).addClass('selected');

		}).dblclick(function(e){

			if($(this).parents('.objectListItem.isFolder').length > 0){
				showContentsInFileWrapper($(this).data('id'));

				$('.foldersWrapper .objectAnchor.selected').closest('.nodeContainer').next('.folderList').removeClass('hide');
				
				$('.foldersWrapper .objectAnchor').removeClass('selected');
				$('.foldersWrapper .objectAnchor[data-id='+ $(this).data('id') +']').addClass('selected');

			}else if($(this).parents('.objectListItem.isFile').length > 0){
				window.location.href = $(this).attr('href');
			}

		});		

		function showContentsInFileWrapper(dataId){
			$('.contentsList').removeClass('shown');
			$('.contentsList[data-id='+ dataId +']').addClass('shown');
		}
	});
</script>