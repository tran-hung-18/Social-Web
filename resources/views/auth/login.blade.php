@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('post-login') }}" class="form-auth form-auth-login">
        @csrf
        <div class="form-auth-logo">
            <img src="{{ Vite::asset('resources/images/LogoRegit.png') }}" alt="">
            <h4>RT-Blogs</h4>
        </div>
        <div class="form-auth-title">
            <p>Sign in</p>
        </div>
        <div class="form-auth-input">
            <label for="email">Username or email<span>*</span></label>
            <input type="text" id="email" name="email">
        </div>
        <div class="form-auth-input">
            <label for="password">Password<span>*</span></label>
            <input type="password" id="password" class="input-password" name="password">
            @if (session('message'))
                <span>{{ session('message') }}</span>
            @endif
            @error ('email')
                <br><span class="noti-error">{{ $message }}</span>
            @enderror
            @error ('password')
                <br><span class="noti-error">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-auth-password">
            <div class="remember-password">
                <div class="checkbox-remember">
                    <input type="checkbox" name="remember">
                </div>
                <p>Remember password</p>
            </div>
            <a href="">Forgot your password?</a>
        </div>
        <div class="form-auth-btn">
            <button type="submit">Login</button>
            <a href="{{ route('view-register') }}">Don't have an account? Sign up here</a>
        </div>
    </form>
</body>
</html>
