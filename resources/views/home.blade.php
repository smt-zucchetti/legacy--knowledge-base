@extends('layouts.mainLayout')

@section('main')
    <div class="smallForm">

        <h2>Dashboard</h2>

        @if (session('status'))
            <div class="validationSuccess visible">{{ session('status') }}</div>
        @endif
        <div class="validationSuccess visible">You are logged in!</div>
    </div>
      
@endsection
