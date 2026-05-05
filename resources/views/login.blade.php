@extends('siswa.layouts.app')

@section('title', 'Login PPDB')

@section('content')
<div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="col-lg-5 col-xl-4">

        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-body p-5">

                <!-- Header -->
                <div class="text-center mb-4">
                    <div class="mb-3">
                        <img src="https://smpn1cilimus.sch.id/wp-content/uploads/2021/07/Untitled-design.png" class="me-2" style="width: 70px" />
                    </div>
                    <h4 class="fw-bold">Login SPBM</h4>
                    <small class="text-muted">SMPN 1 Cilimus 2025/2026</small>
                </div>

                <!-- FORM -->
                <form id="loginForm" method="POST" action="{{ route('auth.authenticate') }}">
                    @csrf

                    <!-- Username -->
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-user"></i>
                            </span>
                            <input type="text"
                                   name="username"
                                   id="username"
                                   class="form-control @error('username') is-invalid @enderror"
                                   placeholder="Masukkan username"
                                   value="{{ old('username') }}"
                                   required autofocus>
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </span>
                            <input type="password"
                                   name="password"
                                   id="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   placeholder="Masukkan password"
                                   required>

                            <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Error -->
                    @if ($errors->any())
                        <div class="alert alert-danger py-2">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <!-- Button -->
                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-primary" id="loginBtn">
                            <i class="fas fa-sign-in-alt me-2"></i>
                            Masuk
                        </button>
                    </div>

                    
                    <!-- Back -->
                    <div class="text-center">
                        <a href="/" class="text-decoration-none">
                            ← Kembali ke Beranda
                        </a>
                    </div>
                    
                    <hr>

                    <!-- Register -->
                    <div class="text-center mt-3">
                        <small class="text-muted">
                            Belum punya akun?
                        </small>
                        <br>
                        <a href="{{ route('pendaftaran.index') }}" class="fw-semibold text-decoration-none">
                            Daftar sekarang
                        </a>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const password = document.getElementById('password');
    const toggle = document.getElementById('togglePassword');
    const form = document.getElementById('loginForm');
    const btn = document.getElementById('loginBtn');

    // Toggle password
    toggle.addEventListener('click', function () {
        if (password.type === 'password') {
            password.type = 'text';
            this.innerHTML = '<i class="fas fa-eye-slash"></i>';
        } else {
            password.type = 'password';
            this.innerHTML = '<i class="fas fa-eye"></i>';
        }
    });

    // Loading submit
    form.addEventListener('submit', function () {
        btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Masuk...';
        btn.disabled = true;
    });

});
</script>
@endpush