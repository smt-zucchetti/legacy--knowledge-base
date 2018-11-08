@extends('layouts.mainLayout')
@section('main')

<form method="POST" action="{{ route('login') }}" class="smallForm">
    <h2>{{ __('Login') }}</h2>

    @csrf

    <label for="email">{{ __('E-Mail Address:') }}
        <input id="email" type="email" class="{{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
        @if ($errors->has('email'))
            <div class="validationError visible">{{ $errors->first('email') }}</div>
        @endif
    </label>      
    
    
    <label for="password">{{ __('Password:') }}
        <input id="password" type="password" class="{{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" required>
        @if ($errors->has('Passwordd'))
            <div class="validationError visible">{{ $errors->first('password') }}</div>
        @endif
    </label>
    
    <label class="form-check-label" for="remember">
        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        {{ __('Remember Me') }}
    </label>
            
    <button type="submit" class="button updateBtn">{{ __('Login') }}</button>

    <a class="link" href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>&nbsp;&nbsp;&nbsp;
    <a class="link" href="{{ route('register') }}">{{ __('Register') }}</a>

</form>
       
@stop
