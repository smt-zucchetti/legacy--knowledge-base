<form class="smallForm" method="post" action="{{ url('/deleteCategory/'.$category->ID) }}">
	
	@csrf
	<h2>Delete Category "{{$category->Name}}"?</h2>

	@include('partials/smallForms/buttons/deleteBtn')
	@include('partials/smallForms/buttons/cancelBtn')
</form>