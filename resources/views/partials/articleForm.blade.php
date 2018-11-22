<form id="kbForm" method="post" action="{{$formType == 'updateArticle'?url('updateArticle/'.$article->id):url('createArticle')}}" class="articleForm" >
	@csrf

	@include('partials/html/validationErrors')
	@include('partials/articleContents', ['readOnly' => false])
	<br><br>
    <button class="button updateBtn" type="submit">Save</button>
</form>

