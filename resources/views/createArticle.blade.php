@extends('layouts.formMaster', ['bodyId'=>'createArticle'])

@section('title', 'New User')

@section('main')

	@include('partials/actionItems', ['items' => array('back')])

	@include('partials/validationErrors')

	@include('partials/articleForm', ['action' => 'create'])

	<script>
		$('#kbForm').submit(function() {
			var rawText = tinyMCE.activeEditor.getContent({format : 'text'});
			$('textarea#textOnlyContent').val(rawText);
		});
	</script>


@stop