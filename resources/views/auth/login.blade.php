@extends('layouts.formMaster')
@section('main')

    <form method="POST" action="{{ route('login') }}" class="authForm">
        <h2>{{ __('Login') }}</h2>

        @csrf

        <label for="email">{{ __('E-Mail Address') }}</label>      
        <input id="email" type="email" class="{{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
        @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
        
        <label for="password">{{ __('Password') }}</label>
        <input id="password" type="password" class="{{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" required>

        @if ($errors->has('Passwordd'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif

        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
        </div>
                
        <button type="submit" class="btn btn-primary">{{ __('Login') }}</button>
        <a class="btn btn-link" href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a><br>
        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>

    </form>
                


@stop
