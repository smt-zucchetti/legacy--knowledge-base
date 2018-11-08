@extends('layouts.mainLayout')

@section('main')

    <form method="POST" action="{{ route('password.update') }}" class="smallForm">
        <h2>{{ __('Reset Password') }}</h2>

        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <label for="email">{{ __('E-Mail Address:') }}
            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>
            @if ($errors->has('email'))
                <div class="validationError visible">{{ $errors->first('email') }}</div>
            @endif
        </label>
        
        <label for="password">{{ __('Password:') }}
            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
            @if ($errors->has('password'))
                <div class="validationError visible">{{ $errors->first('password') }}</div>
            @endif
        </label>
        
        <label for="password-confirm">{{ __('Confirm Password:') }}
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
        </label>

        <button type="submit" class="button updateBtn">{{ __('Reset Password') }}</button>
    </form>
       
@endsection
