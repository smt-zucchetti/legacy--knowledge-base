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
    </div>
      
@endsection
