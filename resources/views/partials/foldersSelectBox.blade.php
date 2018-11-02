<select id="parentId" name="parentId">
	<option value="">Knowledge Base (Root):</option>
	@include('partials/folderTreeOptions', ['folders' => $folderHierarchy])
</select><br><br>