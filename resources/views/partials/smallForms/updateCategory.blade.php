<form class="smallForm updateCategory" method="post" action="{{ url('/updateCategory/'.$category->ID) }}">

	@csrf
	<h2>Edit Category</h2>
	
	<label for="catName"> Name: 
		<input id="catName" type="text" name="name" value="{{$category->Name}}" />
		<div class="validationError">Category name can not be blank</div>
	</label>

	@include('partials/smallForms/buttons/updateBtn')
	@include('partials/smallForms/buttons/cancelBtn')
</form>