@extends('layouts.mainLayout')

@section('main')

            <div class="authContainer">    

                    <form method="POST" action="{{ route('password.update') }}" class="authForm">
                        <h2>{{ __('Reset Password') }}</h2>

                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">
                        <label for="email">{{ __('E-Mail Address') }}</label>
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                        <label for="password">{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif

                        <label for="password-confirm">{{ __('Confirm Password') }}</label>

                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        
                        <button type="submit">
                            {{ __('Reset Password') }}
                        </button>
                    </form>
       </div>   
       
@endsection
