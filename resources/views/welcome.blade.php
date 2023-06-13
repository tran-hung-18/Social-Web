<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <style>
            a {
                margin: 0 30px;
            }
        </style>
    </head>
    <body>
        @if (session('message'))
            <p>{{ session('message') }}</p>
        @endif
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            @if (Auth::user())
                <button type='submit'>Logout</button>
            @endif
        </form>
        <br>
        <a href="{{ route('view-register') }}">Sign up</a>
        <a href="{{ route('view-login') }}">Sign in</a>
    </body>
</html>
