@extends('layouts.formMaster')
@section('main')
<div class="authContainer">

    <form method="POST" action="{{ route('password.email') }}" class="authForm">
        <h2>{{ __('Reset Password') }}</h2>
        
        @csrf
        <label for="email">{{ __('E-Mail Address') }}</label>
        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

        @if ($errors->has('email'))
            <span class="alert invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
        
        <button type="submit" class="btn btn-primary">
            {{ __('Send Password Reset Link') }}
        </button>

         @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
    </form>
  </div>         

@stop
