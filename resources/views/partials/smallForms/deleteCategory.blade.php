<form class="smallForm" method="post" action="{{ url('/deleteCategory/'.$category->id) }}">
	@csrf
	<h2>Delete Category "{{$category->name}}"?</h2>

	@include('partials/smallForms/buttons/deleteBtn')
	@include('partials/smallForms/buttons/cancelBtn')
</form>