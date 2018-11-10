@extends('layouts.mainLayout')

@section('title', 'Edit Article')

@section('main')

	<div class="actionItems actionItemsHeader">
		@include('partials/actionItems', ['items' => [['back', 'Back']]])
	</div>
	
	@include('partials/articleForm', ['formType' => 'updateArticle'])

	<script>
		$('#kbForm').submit(function() {
			var rawText = tinyMCE.activeEditor.getContent({format : 'text'});
			$('textarea#textOnlyContent').val(rawText);
		});
	</script>

@stop