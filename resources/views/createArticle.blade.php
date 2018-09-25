@extends('layouts.formMaster', ['bodyId'=>'createArticle'])

@section('title', 'New User')

@section('main')

<div class="actionItems">
	<a id="goBack" href="<?php echo url('/readArticles') ?>" >
		<i class="fas fa-reply"></i>
		Back
	</a>
</div>

@include('partials/validationErrors')

<form id="kbForm" method="post" action="<?php echo url('createArticle');?>">

 	@csrf

  	<label for="title"><h3>Title:</h3>
  		{{ Form::text('title', null, array('id' => 'title')) }}
    </label>

	<h3>Categories:</h3>
	<ul class="categoryList">
	@foreach($categories as $category)
		<li>
			<label for="{{$category->ID}}">{{$category->Name}}
				<?php 
					if(!empty($article)){
						if(in_array($category->ID, explode(",",$article->categoryIds))){
							//echo '<input type="checkbox" name="CategoryIDs[]" value="'.$category->ID.'" id="'.$category->ID.'" checked />';
							echo Form::checkbox('CategoryIDs[]', $category->ID, false, array('class'=>'asd','id' => $category->ID));

						}else{
							//echo '<input type="checkbox" name="CategoryIDs[]" value="'.$category->ID.'" id="'.$category->ID.'"/>';
							echo Form::checkbox('CategoryIDs[]', $category->ID, false, array('id' => $category->ID));

						}
					}else{
						//echo '<input type="checkbox" name="CategoryIDs[]" value="'.$category->ID.'" id="'.$category->ID.'"/>';
						echo Form::checkbox('CategoryIDs[]', $category->ID, false, array('id' => $category->ID));
					}
				?>
			</label>
		</li>
	@endforeach
	</ul>

	@include('partials/tinyMceForm')

	<input type="submit" value="Save" />
</form>



<script>
	$('#kbForm').submit(function() {
		var rawText = tinyMCE.activeEditor.getContent({format : 'text'});
		$('textarea#textOnlyContent').val(rawText);
	});
</script>


@stop