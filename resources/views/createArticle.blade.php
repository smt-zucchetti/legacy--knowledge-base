@extends('layouts.mainLayout')

@section('title', 'New User')

@section('main')

	@include('partials/actionItems', ['items' => array('back')])
	@include('partials/validationErrors')
	@include('partials/articleForm', ['formType' => 'createArticle'])

	<script>
		$('#kbForm').submit(function() {
			var rawText = tinyMCE.activeEditor.getContent({format : 'text'});
			$('textarea#textOnlyContent').val(rawText);
		});
	</script>


@stop