@extends('layouts.formMaster')

@section('main')
    <div class="authContainer">

        <h2>Dashboard</h2>

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        You are logged in!
        <br><br>
        <h3>Places to Visit</h3>
        <ul class="loggedInLinks">
        	<li><a href="createArticle">Create Article</a></li>
        	<li><a href="articleList">Article List</a></li>
        	<li><a href="">Dashboard</a></li>
        	<li><a href="readFolders">Folder List</a></li>
        	<li><a href="readCategories">Category List</a></li>
        </ul>
    </div>
      
@endsection
