@extends('layouts.mainLayout')

@section('title', 'New User')

@section('main')
	<div class="actionItems actionItemsHeader">
		@include('partials/actionItems', ['items' => [['back', 'Back']], 'objId' => null])
	</div>
	@include('partials/html/validationErrors')
	@include('partials/articleForm', ['formType' => 'createArticle'])

	<script>
		$('#kbForm').submit(function() {
			var rawText = tinyMCE.activeEditor.getContent({format : 'text'});
			$('textarea#textOnlyContent').val(rawText);
		});
	</script>


@stop