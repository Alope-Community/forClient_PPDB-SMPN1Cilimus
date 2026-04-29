@extends('siswa.layouts.app')


@section('title', 'PPDB - Beranda')

@section("content")
<div class="container">
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="row justify-content-center">
        <div class="col-lg-5 col-xl-4">
            <!-- Login Card -->
            <div class="login-card">
                <div class="login-header">
                    <div class="logo-float mb-4">
                        <i class="fas fa-shield-alt fa-4x opacity-75"></i>
                    </div>
                    <h2 class="display-5 fw-bold mb-2">Login</h2>
                    <p class="lead mb-0 opacity-90">PPDB SMPN 1 CILIMUS 2025/2026</p>
                </div>
                
                <form id="loginForm" method="POST" action="{{ route('auth.authenticate') }}">
                    @csrf
                    
                    <div class="login-body mt-3">
                        <!-- Email -->
                        <div class="input-group mb-4">
                            <span class="input-group-text">
                                <i class="fas fa-user"></i>
                            </span>
                            <input type="username" class="form-control form-control-lg @error('username')is-invalid @enderror" 
                                    id="username" name="username" placeholder="Username" required 
                                    value="{{ old('username') }}" autofocus>
                        </div>
                        
                        <!-- Password -->
                        <div class="input-group mb-4">
                            <span class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </span>
                            <input type="password" class="form-control form-control-lg @error('password')is-invalid @enderror" 
                                    id="password" name="password" placeholder="Password" required>
                        </div>
                        
                        <!-- Error Alert -->
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            {{ $errors->first() }}
                        </div>
                        @endif
                        
                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary btn-lg w-100 mb-3">
                            <i class="fas fa-sign-in-alt me-2"></i>
                            Masuk Dashboard
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

    
@push("scripts")
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Password toggle
    const passwordInput = document.getElementById('password');
    const emailInput = document.getElementById('email');
    
    // Focus effect
    emailInput.focus();
    
    // Form submit loading
    document.getElementById('loginForm').addEventListener('submit', function() {
        const btn = this.querySelector('button[type="submit"]');
        btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Masuk...';
        btn.disabled = true;
    });
});
</script>
@endpush