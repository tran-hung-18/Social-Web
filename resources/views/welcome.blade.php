<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
    </head>
    <body class="antialiased">
        @if(session('username'))
            <p>Welcome to {{ session('username') }}</p>
            <a href="{{ route('logout') }}">Logout</a>
        @else
            <a href="{{ route('register') }}">Sign up</a>
            <br>
            <a href="{{ route('login') }}">Sign in</a>
        @endif
    </body>
</html>
