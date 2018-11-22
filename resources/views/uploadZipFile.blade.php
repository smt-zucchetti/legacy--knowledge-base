<form enctype="multipart/form-data" method="POST" action="{{url()->current()}}">
	@csrf
	<input type="file" name="zipFile" />
	<button class="button updateBtn">Submit</button>
</form>