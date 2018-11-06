@extends('layouts.mainLayout')

@section('title', 'Dashboard')

@section('main')

@if (Auth::check())
	<div class="actionItems">
		<a class="addArticle" href="<?php echo url('/createArticle') ?>">
			<i class="fas fa-plus"></i> Add New 
		</a>
	</div>
@endif

@include('partials/searchForm')

@if (!empty($featuredArticles))
	@include('partials/featuredArticles' )
@endif

@include('partials/articleList')

@stop
