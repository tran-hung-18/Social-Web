<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social THH</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
</head>
<body>
    <form method="POST" action="{{ route('post-login') }}" class="form-auth form-auth-login">
        @csrf
        <div class="form-auth-logo">
            <img src="{{ asset('img/LogoRegit.png') }}" alt="">
            <h4>RT-Blogs</h4>
        </div>
        <div class="form-auth-title">
            <p>Sign in</p>
        </div>
        <div class="form-auth-input">
            <label for="username">Username or email<span>*</span></label>
            <input type="text" id="username" name="email">
        </div>
        <div class="form-auth-input">
            <label for="password">Password<span>*</span></label>
            <input type="password" id="password" class="input-password" name="password">
            @if(session('error'))
                <span>{{ session('error') }}</span>
            @endif
            @if(session('success'))
                <span>{{ session('success') }}</span>
            @endif
            @error('email')
                <br><span class="noti-error">{{$message }}</span>
            @enderror
            @error('password')
                <br><span class="noti-error">{{$message }}</span>
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
            <a href="{{ route('register') }}">Don't have an account? Sign up here</a>
        </div>
    </form>
</body>
</html>
