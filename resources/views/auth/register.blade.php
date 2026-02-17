@extends('layouts.app')

@section('title', 'Register - SITRIN')

@section('content')
<section class="auth-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="auth-card bg-white p-5 rounded-3 shadow">
                    <div class="text-center mb-4">
                        <h2 class="text-dark-green mb-2">Create Account</h2>
                        <p class="text-muted">Join the SITRIN family</p>
                    </div>
                    
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required autofocus>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                            <small class="text-muted">Must be at least 8 characters with uppercase, lowercase, number, and special character</small>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>
                        
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-person-plus me-2"></i>Create Account
                            </button>
                        </div>
                        
                        <div class="text-center">
                            <p class="text-muted mb-0">
                                Already have an account? 
                                <a href="{{ route('login') }}" class="text-primary text-decoration-none">Login here</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
