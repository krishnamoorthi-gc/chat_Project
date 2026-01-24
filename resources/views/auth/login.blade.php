@extends('layouts.auth')

@section('content')
<div class="auth-container">
    <div class="auth-left">
        <div class="auth-header">
            <div class="auth-logo">
                <i class="bi bi-robot"></i> ChatApp
            </div>
            <p class="auth-subtitle">Welcome back! Please login to your account.</p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="auth-form-group">
                <label for="email" class="auth-label">{{ __('Email Address') }}</label>
                <input id="email" type="email" class="auth-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="hello@example.com">
                @error('email')
                    <span class="invalid-feedback d-block mt-1" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="auth-form-group">
                <div class="d-flex justify-content-between">
                    <label for="password" class="auth-label">{{ __('Password') }}</label>
                    @if (Route::has('password.request'))
                        <a class="auth-link small" href="{{ route('password.request') }}">
                            {{ __('Forgot Password?') }}
                        </a>
                    @endif
                </div>
                <input id="password" type="password" class="auth-input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="••••••••">
                @error('password')
                    <span class="invalid-feedback d-block mt-1" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="auth-form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label text-muted small" for="remember">
                        {{ __('Remember me') }}
                    </label>
                </div>
            </div>

            <button type="submit" class="auth-btn">
                {{ __('Login') }}
            </button>
            
            <div class="auth-footer">
                New User? <a href="{{ route('register') }}" class="auth-link">Create an Account</a>
            </div>
        </form>
    </div>

    <div class="auth-right d-none d-md-flex">
        <div class="auth-circle-1"></div>
        <div class="auth-circle-2"></div>
        
        <div class="auth-feature-box">
            <div class="auth-feature-icon">
                <i class="bi bi-chat-dots-fill"></i>
            </div>
            <h3>Build Smart Chatbots</h3>
            <p class="mt-3 opacity-75">Train your AI with PDF, Excel, and Web content in minutes.</p>
        </div>
    </div>
</div>
@endsection
