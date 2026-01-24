@extends('layouts.auth')

@section('content')
<div class="auth-container">
    <div class="auth-left">
        <div class="auth-header">
            <div class="auth-logo">
                <i class="bi bi-robot"></i> ChatApp
            </div>
            <p class="auth-subtitle">Create a free account to get started.</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="auth-form-group">
                <label for="name" class="auth-label">{{ __('Name') }}</label>
                <input id="name" type="text" class="auth-input @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="John Doe">
                @error('name')
                    <span class="invalid-feedback d-block mt-1" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="auth-form-group">
                <label for="company_name" class="auth-label">{{ __('Company Name') }}</label>
                <input id="company_name" type="text" class="auth-input @error('company_name') is-invalid @enderror" name="company_name" value="{{ old('company_name') }}" required autocomplete="company_name" placeholder="Acme Inc.">
                @error('company_name')
                    <span class="invalid-feedback d-block mt-1" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="auth-form-group">
                <label for="email" class="auth-label">{{ __('Email Address') }}</label>
                <input id="email" type="email" class="auth-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="john@example.com">
                @error('email')
                    <span class="invalid-feedback d-block mt-1" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="auth-form-group">
                <label for="password" class="auth-label">{{ __('Password') }}</label>
                <input id="password" type="password" class="auth-input @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="••••••••">
                @error('password')
                    <span class="invalid-feedback d-block mt-1" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="auth-form-group">
                <label for="password-confirm" class="auth-label">{{ __('Confirm Password') }}</label>
                <input id="password-confirm" type="password" class="auth-input" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••">
            </div>

            <button type="submit" class="auth-btn">
                {{ __('Register') }}
            </button>
            
            <div class="auth-footer">
                Already have an account? <a href="{{ route('login') }}" class="auth-link">Login Here</a>
            </div>
        </form>
    </div>

    <div class="auth-right d-none d-md-flex">
        <div class="auth-circle-1"></div>
        <div class="auth-circle-2"></div>
        
        <div class="auth-feature-box">
            <div class="auth-feature-icon">
                <i class="bi bi-rocket-takeoff-fill"></i>
            </div>
            <h3>Start Your Journey</h3>
            <p class="mt-3 opacity-75">Join thousands of businesses automating support with AI.</p>
        </div>
    </div>
</div>
@endsection
