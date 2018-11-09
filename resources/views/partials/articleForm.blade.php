@if($formType == "updateArticle")
	@php($url = url('updateArticle/'.$article->ID) )
@elseif($formType == "createArticle")
	@php($url = url('createArticle') )
@endif

<form id="kbForm" method="post" action="{{$url}}" class="articleForm" >
	
	@include('partials/html/validationErrors')
	@csrf

	@include('partials/articleContents', ['readOnly' => false])
	<br><br>
    <button class="button updateBtn" type="submit">Save</button>
</form>

