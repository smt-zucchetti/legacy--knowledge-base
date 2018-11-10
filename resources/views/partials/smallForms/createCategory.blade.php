<form class="smallForm" method="post" action="{{ url('createCategory') }}">
	@csrf
	<h2>Add New Category</h2>
	<div class="validationError hidden">Category Name is empty</div>
	<label for="catName">Name: 
		<input id="catName" type="text" name="name" />
	</label>
	<button class="button createBtn" type="submit">Create</button>
</form>