@extends('layouts.mainLayout')

@section('title', 'All Articles')

@section('main')

@if (Auth::check())
	<div class="actionItems">
		<a class="addArticle" href="<?php echo url('/createArticle') ?>">
			<i class="fas fa-plus"></i> Add New 
		</a>
	</div>
@endif

@include('partials/smallForms/basicSearchForm')

<ul class="fileManagerView">
	<li>
		<a class="{{($type == 'list')?'active':''}}" href="{{url('/articleList')}}">List</a>
	</li>
	<li>
		<a class="{{($type == 'tree')?'active':''}}" href="{{url('/articleTree')}}">Tree</a>
	</li>
	<li>
		<a class="{{($type == 'GUI')?'active':''}}" href="{{url('/articleGUI')}}">GUI</a>
	</li>
</ul>

<div class="fileManager">
	@if($type == 'list')
		@include('partials/articleList')
	@elseif($type == 'tree')
		@include('partials/articleTree')
	@elseif($type == 'GUI')
		@include('partials/articleGUI')
	@endif
</div>




@stop
