@extends('layouts.mainLayout')

@section('main')
    <div class="smallForm">

        <h2>Dashboard</h2>

        @if (session('status'))
            <div class="validationSuccess visible">{{ session('status') }}</div>
        @endif
        @if (Auth::check())
	        <div>You are logged in!</div>
	    @else
	    	<div>You are not currently logged in</div>
	    @endif
    </div>
      
@endsection
