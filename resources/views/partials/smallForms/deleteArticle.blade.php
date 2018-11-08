<form method="post" class="smallForm" action="{{ url('/deleteArticle/'.$article->ID) }}">
	@csrf
	<h2>Delete Article "{{$article->Title}}"?</h2>
	
	@include('partials/smallForms/buttons/deleteBtn')
	@include('partials/smallForms/buttons/cancelBtn')
</form>