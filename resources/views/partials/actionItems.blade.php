<div class="actionItems">
	@if(in_array('back', $items))
		<a id="goBack" href="javascript:window.history.back();" >
			<i class="fas fa-reply"></i>
			Back
		</a>
	@endif

	@if(in_array('deleteArticle', $items) && Auth::check())
		<div style="display: none;" id="deleteArticleTmp">
			<form method="post" action="{{ url('deleteArticle/'.$article->ID) }}">
				@csrf
				<h2>Delete the Article?</h2>
				<input type="submit" value="Delete" />
				<button class="cancelButton" type="button" data-fancybox-close="" >
					Cancel
				</button>
			</form>
		</div>
		<a data-fancybox data-src="#deleteArticleTmp" href="javascript:;">
			<i class="fas fa-trash-alt"></i> Delete 
		</a>
	@endif

	@if(in_array('editArticle', $items) && Auth::check())
		<a id="editArticle" href="{{ url('/updateArticle/'.$article->ID) }}" >
			<i class="fas fa-pencil-alt"></i>
			Edit
		</a>
	@endif
</div>