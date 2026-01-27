@extends('layouts.auth')

@section('content')
<div class="auth-container">
    <div class="auth-left">
        <div class="auth-header">
            <div class="auth-logo">
                <i class="bi bi-robot" style="color: #6c5dd3;"></i> Admin Panel
            </div>
            <p class="auth-subtitle">Login to access the administration dashboard.</p>
        </div>

        <form method="POST" action="{{ route('admin.login') }}">
            @csrf
            
            <div class="auth-form-group">
                <label for="email" class="auth-label">Username or Email</label>
                <input id="email" type="text" class="auth-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus placeholder="admin">
                @error('email')
                    <span class="invalid-feedback d-block mt-1" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="auth-form-group">
                <label for="password" class="auth-label">Password</label>
                <input id="password" type="password" class="auth-input @error('password') is-invalid @enderror" name="password" required placeholder="••••••••">
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
                        Remember me
                    </label>
                </div>
            </div>

            <button type="submit" class="auth-btn">
                Log In
            </button>
        </form>
    </div>

    <div class="auth-right d-none d-md-flex" style="background: linear-gradient(135deg, #1a1b1e 0%, #2b2c31 100%);">
        <div class="auth-circle-1" style="background: rgba(108, 93, 211, 0.1);"></div>
        <div class="auth-circle-2" style="background: rgba(108, 93, 211, 0.05);"></div>
        
        <div class="auth-feature-box text-center">
            <div class="auth-feature-icon" style="background: #6c5dd3; color: white; display: inline-flex; align-items: center; justify-content: center; width: 60px; height: 60px; border-radius: 15px; margin-bottom: 20px;">
                <i class="bi bi-shield-lock-fill" style="font-size: 24px;"></i>
            </div>
            <h3 class="text-white">Admin Management</h3>
            <p class="mt-3 text-white opacity-75">Control users, monitor bots, and manage plans across the platform.</p>
        </div>
    </div>
</div>
@endsection
