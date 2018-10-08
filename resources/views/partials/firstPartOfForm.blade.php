

	<label for="title"><h3>Title:</h3>
  		{{ Form::text('title', !empty($article->Title)?$article->Title:'', array('id' => 'title')) }}
    </label>

    <ul class="featured formCheckbox">
    	<li>
    		<label for="featured"><h3>Featured</h3>
	  <input type="checkbox" name="featured" <?php echo !empty($article->featured)?"checked='".$article->featured."'":""; ?> id="featured" value="1" />
	    	</label>
    	</li>
    </ul>

    <h3>Folder:</h3>
	<ul class="categoryList formCheckbox">
	@foreach($folders as $folder)
		<li>
			<label for="{{$folder->id}}">{{$folder->name}}
				<?php 
					if(!empty($article) && $folder->id === $article->folderId){
						echo Form::radio('folderId', $folder->id, true, array('id' => $folder->id));
					}else{
						echo Form::radio('folderId', $folder->id, false, array('id' => $folder->id));
					}
				?>
			</label>
		</li>
	@endforeach
	</ul>


	<h3>Categories:</h3>
	<ul class="categoryList formCheckbox">
	@foreach($categories as $category)
		<li>
			<label for="{{$category->ID}}">{{$category->Name}}
				<?php 
					if(!empty($article) && in_array($category->ID, explode(",",$article->categoryIds))){
						echo Form::checkbox('CategoryIDs[]', $category->ID, true, array('id' => $category->ID));
					}else{
						echo Form::checkbox('CategoryIDs[]', $category->ID, false, array('id' => $category->ID));
					}
				?>
			</label>
		</li>
	@endforeach
	</ul>