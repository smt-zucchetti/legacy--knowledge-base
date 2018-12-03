<form enctype="multipart/form-data" method="POST" action="{{url()->current()}}">
	@csrf
	<!--<input type="file" name="zipFile" />-->
	File ID: <input type="text" name="fileId" />
	<button class="button updateBtn">Submit</button>
</form>