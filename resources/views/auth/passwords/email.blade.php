@extends('layouts.mainLayout')
@section('main')

    <form method="POST" action="{{ route('password.email') }}" class="smallForm">
        <h2>{{ __('Reset Password') }}</h2>
        
        @csrf
        <label for="email">{{ __('E-Mail Address: ') }}
            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
            @if ($errors->has('email'))
                <div class="validationError visible">{{ $errors->first('email') }}</div>
            @endif
        </label>
        
        <button type="submit" class="button updateBtn">
            {{ __('Send Password Reset Link') }}
        </button>

         @if (session('status'))
            <div class="validationSucess visible">{{ session('status') }}</div>
        @endif
    </form>

@stop
