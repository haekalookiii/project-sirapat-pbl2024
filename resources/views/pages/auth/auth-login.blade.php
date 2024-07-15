@extends('layouts.auth')

@section('title', 'Login')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/bootstrap-social/bootstrap-social.css') }}">
@endpush

@section('main')
    <div class="card card-primary">
        <div class="card-header">
            <div class="login-brand">
            <img src="{{ asset('img/FIX.png') }}"
                alt="logo"
                width="100"
                class="shadow-light rounded-circle">
        </div>
            <h1>Sistem Informasi Rapat HME</h1>
        </div>
            
        <div class="card-body">
            <h7>Login ke Akun Anda</h7>
            <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate="">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                        <div class="input-group">    
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" tabindex="1" autofocus>
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-user"></i>
                            </span>
                        </div>
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                    </div>
                </div>
                <div class="form-group">
                    <div class="d-block">
                        <label for="password" class="control-label">Password</label>
                        <!-- <div class="float-right">
                        <a href="{{ route('forget') }}" class="text-small">Forgot Password?</a>
                        </div> -->
                    </div>
                    <div class="input-group">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" tabindex="2">
                        <div class="input-group-append">
                        <span class="input-group-text">
                            <i class="fas fa-eye-slash" id="togglePassword"></i>
                        </span>
                        </div>
                    
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                        Login
                    </button>
                </div>
            </form>

        </div>

    </div>
<script>
    document.getElementById("togglePassword").addEventListener("click", function() {
        var passwordInput = document.getElementById("password");
        var eyeIcon = document.getElementById("togglePassword");
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            eyeIcon.classList.remove("fa-eye-slash");
            eyeIcon.classList.add("fa-eye");
        } else {
            passwordInput.type = "password";
            eyeIcon.classList.remove("fa-eye");
            eyeIcon.classList.add("fa-eye-slash");
        }
    });
</script>


@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush
