@extends('layouts.formMaster',['bodyId'=>'editArticle'])

@section('title', 'New User')

@section('main')

<div class="action-icons">
	<a id="goBack" href="javascript:window.history.back();" >
		<i class="fas fa-reply"></i>
		Back
	</a>
</div>
<form id="kbForm" method="post" action="<?php echo url('updateArticle/'.$article->ID);?>">
	@include('partials/tinyMceForm', ['article' => $article ] )
</form>


@stop