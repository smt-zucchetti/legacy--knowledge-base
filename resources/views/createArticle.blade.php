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

<form id="kbForm" method="post" action="<?php echo url('createArticle');?>" class="articleContainer">

 	@csrf

	@include('partials/firstPartOfForm')

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