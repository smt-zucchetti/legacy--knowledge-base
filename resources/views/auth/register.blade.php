@extends('layouts.mainLayout')

@section('main')
                
    @if(!empty($restrictedEmailAddress) && $restrictedEmailAddress)
        This email address not allowed
    @endif

    <form method="POST" action="{{ route('register') }}" class="smallForm">
        <h2>{{ __('Register') }}</h2>

        @csrf

        <label for="name">{{ __('Name:') }}
            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
            @if ($errors->has('name'))
                <div class="validationError visible">{{ $errors->first('name') }}</div>
            @endif
        </label>    
                    
        <label for="email">{{ __('E-Mail Address:') }}
            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
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
        
        <button type="submit" class="button updateBtn">{{ __('Register') }}</button>

    </form>  

@endsection
