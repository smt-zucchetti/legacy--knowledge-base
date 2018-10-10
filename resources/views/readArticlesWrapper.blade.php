@extends('layouts.formMaster')

@section('title', 'All Articles')

@section('main')

@if (Auth::check())
	<div class="actionItems">
		<a class="addArticle" href="<?php echo url('/createArticle') ?>">
			<i class="fas fa-plus"></i> Add New 
		</a>
	</div>
@endif

<div class="smallSearchForm">
	<form method="post" action="<?php echo url('/searchArticles') ?>" >
	   @csrf
	  Search: <input type="text" name="search" value="<?php echo !empty($searchTerm)?$searchTerm:''; ?>" />
	  <input type="submit" value="Search" />
	</form>
	<a class="advSearch" href="<?php echo url('/search') ?>">Advanced Search</a>
</div>


<ul class="fileManagerView">
	<li>
		<a href="{{url('/articleTree')}}">Tree</a>
	</li>
	<li>
		<a href="{{url('/articleGUI')}}">GUI</a>
	</li>
</ul>

<div class="fileManager">
	@if($type == 'articleTree')
		<div class="articleTree">
			@include('partials/articleTree', ['folders' => $folders ])
		</div>
	@elseif($type == 'articleGUI')
		@include('partials/articleGUI')
	@endif
</div>


<script>

	$('.fileManager').on('dblclick', '.fa-file', function(){
			
			var fileId = $(this).closest('.fileOrFolder').data('id');
			var url = 'readArticle/' + fileId;

			location.href = url;
		});
</script>


@stop
