@extends('layouts.mainLayout')

@section('title', 'Dashboard')

@section('main')

@if (Auth::check())
	@include('partials/html/actionItems', ['items' => array('back', 'createArticle')])

	<div class="actionItems">
		<a class="addArticle" href="{{ url('/createArticle') }}">
			<i class="fas fa-plus"></i> Add New 
		</a>
	</div>
@endif

@if (!empty($featuredArticles))
	@include('partials/featuredArticles' )
@endif

@include('partials/smallForms/basicSearchForm')

@include('partials/articleList')

@stop
