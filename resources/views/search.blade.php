@extends('layouts.formMaster')

@section('title', 'Advanced Search')

@section('main')

	<div class="container">

		<form id="searchForm" method="post" action="<?php echo url('search');?>" class="articleContainer">

		 	@csrf

		 	<label for="category">
		 		<h3>Category:</h3>
		 	</label>
			<select name="category" id="category">
				<option selected value> -- select an option -- </option>
				@foreach($categories as $category)
					<option value="{{$category->Name}}">{{$category->Name}}</option>
				@endforeach
			</select>
			
			<label for="title">
				<h3>Title:</h3>
			</label>
			<input id="title" type="text" name="Title" />

			<label for="dateCreated">
				<h3>Date Created:</h3>
			</label>
			<input name="dateCreated" id="datepicker" />

			<label></label>
			<input type="submit" value="Search" />
		</form>
	</div>


	<script>
		$( function() {
	    	$( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
	  	});
	 </script>

@stop