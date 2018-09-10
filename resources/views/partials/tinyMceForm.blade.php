




 	@csrf
 	<section class="form-group">
	 	<label for="title"><h3>Title:</h3>
		    <input id="title" type="input" name="title" value="{{!empty($article)?$article->Title:'' }}" />
	    </label>
	</section>

	<section class="form-group">
	    <div class="categoryList">
	    	<h3>Categories:</h3>
			<ul>
			@foreach($categories as $category)
				<li>
					<label for="{{$category->ID}}">
						{{$category->Name}}
						<?php 
							if(!empty($article)){
								if(in_array($category->ID, explode(",",$article->categoryIds))){
									echo '<input type="checkbox" name="CategoryIDs[]" value="'.$category->ID.'" id="'.$category->ID.'" checked />';
								}else{
									echo '<input type="checkbox" name="CategoryIDs[]" value="'.$category->ID.'" id="'.$category->ID.'"/>';
								}
							}else{
								echo '<input type="checkbox" name="CategoryIDs[]" value="'.$category->ID.'" id="'.$category->ID.'"/>';
							}
						?>
					</label>
				</li>
			@endforeach
			</ul>
		</div>
	</section>

	<section class="form-group">
	    <label for="content"><h3>Content:</h3> </label>
	    <textarea id="tinyMCE" name="content" class="form-control my-editor"></textarea>
	    <textarea id="textOnlyContent" name="textOnlyContent" >{{!empty($article)?$article->Content:''}}</textarea>
	</section>

    <input type="submit" value="Save" />

<script>
	/*$(document).ready(function(){
		tinyMCE.activeEditor.setContent($('textarea#textOnlyContent').text());
	});
	$('form#kbForm').submit(function(){
		$('#textOnlyContent').append(tinyMCE.activeEditor.getContent({ format: 'text' }));

		return true;
	});*/
</script>