@extends('layouts.mainLayout')

@section('title', 'Dashboard')

@section('main')

@if (Auth::check())
	<div class="actionItems">
		<a class="addArticle" href="{{ url('/createArticle') }}">
			<i class="fas fa-plus"></i> Add New 
		</a>
	</div>
@endif

@if (!empty($featuredArticles))
	@include('partials/featuredArticles' )
@endif

@include('partials/searchForm')

@include('partials/articleList')

@stop
