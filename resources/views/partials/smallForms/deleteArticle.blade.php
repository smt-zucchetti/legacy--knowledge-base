<form method="post" class="smallForm" action="{{ url('/deleteArticle/'.$article->id) }}">
	@csrf
	<h2>Delete Article "{{$article->title}}"?</h2>
	
	@include('partials/smallForms/buttons/deleteBtn')
	@include('partials/smallForms/buttons/cancelBtn')
</form>