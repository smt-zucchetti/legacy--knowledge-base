@extends('layouts.formMaster')

@section('main')

    <div class="authContainer">
        <h2>Verify Your Email Address</h2>

        @if (session('resent'))
            <div class="alert" role="alert">
                A fresh verification link has been sent to your email address.
            </div>
        @endif

        Before proceeding, please check your email for a verification link.
        If you did not receive the email, <a href="{{ route('verification.resend') }}">click here to request another</a>.
    </div>
      
@endsection
