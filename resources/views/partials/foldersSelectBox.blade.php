<label for="parentId">Parent Folder {{ !empty($curFolder)?$curFolder->parentId:"" }}</label>
<select id="parentId" name="parentId">
	<option value="">Knowledge Base:</option>
	@include('partials/folderTreeOptions', ['folders' => $folderHierarchy])
</select><br><br>