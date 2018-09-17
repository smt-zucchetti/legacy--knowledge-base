@extends('layouts.formMaster',['bodyId'=>'editArticle'])

@section('title', 'New User')

@section('main')

	<form method="post" action="<?php echo url('/logIn'); ?>">
		@csrf
		<label for="userName">
			User Name: <input type="text" name="userName" />
		</label>
		<label for="password">
			Password: <input type="text" name="password" />
		</label>
		<input type="submit" value="Log In" />
	</form>

	<?php if(!empty($failedLogin) && $failedLogin): ?>
		Failed Login
	<?php endif; ?>

@stop

