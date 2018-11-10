@switch($formType)
	@case("updateArticle")
		@php($url = url('updateArticle/'.$article->id) )
		@break
	@case("createArticle")
		@php($url = url('createArticle') )
		@break
@endswitch

<form id="kbForm" method="post" action="{{$url}}" class="articleForm" >
	
	@include('partials/html/validationErrors')
	@csrf

	@include('partials/articleContents', ['readOnly' => false])
	<br><br>
    <button class="button updateBtn" type="submit">Save</button>
</form>

