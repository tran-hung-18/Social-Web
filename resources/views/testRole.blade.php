<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
    </head>
    <body>
        @if (session('message'))
            <p>{{ session('message') }}</p>
        @endif
        @if (Auth::user())
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                    <button type='submit'>Logout</button>
            </form>
        @endif
        <br>
        @if (Auth::user()->role == 1)
            <a href="{{ route('home-admin') }}">Management</a>
        @elseif (Auth::user() == 2)
            <a href="{{ route('home-user') }}">Home User</a>
        @else
            <a href="{{ route('view-register') }}">Sign up</a>
            <a href="{{ route('view-login') }}">Sign in</a>
        @endif

    </body>
</html>
