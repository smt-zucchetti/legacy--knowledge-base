
@extends('layouts.mainLayout', ['bodyId'=>'singleArticle'])

@section('title', 'New User')

@section('main')

	@include('partials/actionItems', ['items' => array('back', 'deleteArticle', 'editArticle')])
	
	<div class="articleContainer">
		@include('partials/articleContents', ['readOnly' => true] )
	</div>

@stop