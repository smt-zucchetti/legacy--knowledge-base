

@if($action == "update")
	@php($url = url('updateArticle/'.$article->ID) )
@elseif($action == "create")
	@php($url = url('createArticle') )
@endif

<form id="kbForm" method="post" action="{{$url}}" >
	@csrf

	<label for="title"><span class="label">Title:</span>
  		{{ Form::text('title', !empty($article->Title)?$article->Title:'', array('id' => 'title')) }}
    </label>

    <label for="featured"><span class="label">Featured:</span>
		<input type="checkbox" name="featured" <?php echo !empty($article->featured)?"checked='".$article->featured."'":""; ?> id="featured" value="1" />
	</label>
    	
	<span class="label">Categories:</span>
	<ul class="categoryList formCheckbox">
	@foreach($categories as $category)
		<li>
			<label for="{{$category->ID}}"><span class="checkboxLabel">{{$category->Name}}</span>
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
	@include('partials/foldersSelectBox')

    <label for="content"><span class="label">Content:</span> </label>
    {{ Form::textarea('content', !empty($article->Content)?$article->Content:"", array('class' => 'form-control my-editor', 'id' => 'tinyMCE')) }}
    <textarea id="textOnlyContent" name="textOnlyContent" >{{!empty($article)?$article->textOnlyContent:''}}</textarea>

    <input type="submit" value="Save" />
</form>

