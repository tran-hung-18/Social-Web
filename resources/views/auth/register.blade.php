<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - THH</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
</head>
<body>
    <form method="POST" action="{{ route('post-register') }}" class="form-auth form-auth-register">
        @csrf
        <div class="form-auth-logo">
            <img src="{{ asset('img/LogoRegit.png') }}" alt="">
            <h4>RT-Blogs</h4>
        </div>
        <div class="form-auth-title">
            <p>Sign up</p>
        </div>
        <div class="form-auth-input">
            <label for="username">Username<span>*</span></label>
            <input type="text" id="username" name="username">
        </div>
        <div class="form-auth-input">
            <label for="email">Email<span>*</span></label>
            <input type="text" id="email" name="email">
        </div>
        <div class="form-auth-input">
            <label for="password">Password<span>*</span></label>
            <input type="password" id="password" class="input-password" name="password">
        </div>
        <div class="form-auth-input">
            <label for="password-confirm">Password Confirm<span>*</span></label>
            <input type="password" id="password-confirm" class="input-password-confirm" name="password_confirmed">
        </div>
        <div class="form-auth-btn form-register">
            <button type="submit">Sign up</button>
            <a href="">Already have an account? Login</a>
        </div>
    </form>
</body>
</html>
