<form class="smallForm" method="post" action="{{ url('/updateCategory/'.$category->id) }}">
	@csrf
	<h2>Edit Category</h2>
	
	<label for="catName"> Name: 
		<input id="catName" type="text" name="name" value="{{$category->name}}" />
		<div class="validationError">Category name can not be blank</div>
	</label>

	@include('partials/smallForms/buttons/updateBtn')
	@include('partials/smallForms/buttons/cancelBtn')
</form>