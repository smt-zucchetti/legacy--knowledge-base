
@extends('layouts.mainLayout')

@section('title', 'New User')

@section('main')
	<div class="actionItems actionItemsHeader">
		@include('partials/actionItems', ['items' => [['back', 'Back'], ['deleteArticle', 'Delete'], ['updateArticle', 'Update']], 'objId' => $article->id])
	</div>
	<div class="articleContainer">
		@include('partials/articleContents', ['readOnly' => true] )
	</div>

@stop