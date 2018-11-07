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

			$(this).closest('li.folderList').find('ul').toggleClass('hide');
			$(this).find('.fa-minus-square, .fa-plus-square').toggleClass('hide');
			$(this).find('.folder').toggleClass('selected');
		});

		$('.foldersWrapper .folder').click(function(e){
			e.preventDefault();

			$('.folder').removeClass('selected');
			$(this).addClass('selected');

			$('.contentsList').removeClass('shown');
			$('.contentsList[data-id='+ $(this).data('id') +']').addClass('shown');
		});

		$('.filesWrapper .folder, .filesWrapper .file').click(function(e){
			e.preventDefault();
			
			$('.filesWrapper .folder, .filesWrapper .file').removeClass('selected');
			$(this).addClass('selected');
		});

		$('.filesWrapper .folder, .filesWrapper .file').dblclick(function(e){
			//e.preventDefault();

			if($(this).hasClass('folder')){
				$('.contentsList').removeClass('shown');
				$('.contentsList[data-id='+ $(this).data('id') +']').addClass('shown');

				$('.folderList .folder.selected ~ ul').removeClass('hide');
				$('.folderList .folder').removeClass('selected');
				$('.folderList .folder[data-id='+ $(this).data('id') +']').addClass('selected');

			}else if($(this).hasClass('file')){
				window.location.href = $(this).attr('href');
			}

		});		
	});
</script>