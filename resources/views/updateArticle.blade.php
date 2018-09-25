@extends('layouts.formMaster',['bodyId'=>'editArticle'])

@section('title', 'Edit Article')

@section('main')

<div class="actionItems">
	<a id="goBack" href="javascript:window.history.back();" >
		<i class="fas fa-reply"></i>
		Back
	</a>
</div>

@include('partials/validationErrors')

<form id="kbForm" method="post" action="<?php echo url('updateArticle/'.$article->ID);?>">

	@csrf
	<label for="title"><h3>Title:</h3>
  		{{ Form::text('title', $article->Title, array('id' => 'title')) }}
    </label>

    <h3>Categories:</h3>
	<ul class="categoryList">
	@foreach($categories as $category)
		<li>
			<label for="{{$category->ID}}">{{$category->Name}}
				<?php 
					if(!empty($article)){
						if(in_array($category->ID, explode(",",$article->categoryIds))){
							echo Form::checkbox('CategoryIDs[]', $category->ID, true, array('class'=>'asd','id' => $category->ID));

						}else{
							echo Form::checkbox('CategoryIDs[]', $category->ID, false, array('id' => $category->ID));

						}
					}else{
						echo Form::checkbox('CategoryIDs[]', $category->ID, false, array('id' => $category->ID));
					}
				?>
			</label>
		</li>
	@endforeach
	</ul>

	@include('partials/tinyMceForm', ['article' => $article ] )

	<input type="submit" value="Save" />
</form>


<script>
	$('#kbForm').submit(function() {
		var rawText = tinyMCE.activeEditor.getContent({format : 'text'});
		$('textarea#textOnlyContent').val(rawText);
	});
</script>

@stop