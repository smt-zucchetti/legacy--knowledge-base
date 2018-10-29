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

			$(this).closest('li.folderList').find('ul').toggle();
			$(this).find('.fa-minus-square, .fa-plus-square').toggleClass('hide');
			$(this).find('.folder').toggleClass('selected');
		});

		$('.folder').click(function(e){
			e.preventDefault();

			$('.folder').removeClass('selected');
			$(this).addClass('selected');

			$('.fileList').removeClass('selected');
			$('.fileList[data-id='+ $(this).data('id') +']').addClass('selected');
		});


		$('body').click(function(evt){
			$('.fileOrFolder').removeClass('selected');

			if($(evt.target).hasClass('fa-folder') || $(evt.target).hasClass('fa-file')){
				$(evt.target).closest('.fileOrFolder').addClass('selected');
			}
		});

		
	});
</script>