@extends('layout')

@section('title', 'Register')


<div class="d-flex justify-content-center align-items-center" style="height: 100vh; background-color: #f4f4f9;">
    <div class="register-container" style="width: 100%; max-width: 400px; padding: 2rem; background-color: #fff; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
        <h2 class="text-center">Register</h2>

        <!-- Form for registration -->
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Enter your full name" required value="{{ old('name') }}">
                @error('name')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required value="{{ old('email') }}">
                @error('email')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
                @error('password')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm your password" required>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary w-100">Register</button>
        </form>

        <div class="mt-3 text-center">
            <a href="{{ route('login') }}" class="text-decoration-none">Already have an account? Login here</a>
        </div>
    </div>
</div>

