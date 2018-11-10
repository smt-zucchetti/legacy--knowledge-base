@extends('layouts.mainLayout')

@section('title', 'Dashboard')

@section('main')

<div class="actionItems actionItemsHeader">
	@include('partials/actionItems', ['items' => [['back','Back'], ['createArticle', 'Add New']], 'objId' => null])
</div>

@if (!empty($featuredArticles))
	@include('partials/featuredArticles' )
@endif

@include('partials/smallForms/basicSearchForm')

@include('partials/articleList')

@stop
