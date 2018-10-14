@extends('layouts.formMaster',['bodyId'=>'editArticle'])

@section('title', 'Edit Article')

@section('main')


@include('partials/actionItems', ['items' => array('back')])

@include('partials/validationErrors')

<form id="kbForm" method="post" action="<?php echo url('updateArticle/'.$article->ID);?>" class="articleContainer">

	@csrf

	@include('partials/firstPartOfForm')
	@include('partials/folderFormFields')
	
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