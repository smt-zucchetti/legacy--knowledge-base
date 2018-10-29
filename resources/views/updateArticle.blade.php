@extends('layouts.mainLayout',['bodyId'=>'editArticle'])

@section('title', 'Edit Article')

@section('main')

	@include('partials/actionItems', ['items' => array('back')])

	@include('partials/validationErrors')

	@include('partials/articleForm', ['action' => 'update'])

	<script>
		$('#kbForm').submit(function() {
			var rawText = tinyMCE.activeEditor.getContent({format : 'text'});
			$('textarea#textOnlyContent').val(rawText);
		});
	</script>

@stop