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
    @vite(['resources/js/home.js'])
    @vite(['resources/scss/app.scss'])
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
</head>
<body>
    <div class="header">
        <div class="container-header">
            <div class="header-mobile">
                <img src="{{ Vite::asset('resources/images/Vector.svg') }}" class="icon-show-menu" alt="">
                <a href="{{ route('blogs.home') }}" class="logo-header">
                    <img src="{{ Vite::asset('resources/images/7d85462e-ed1f-4b7b-b617-ad57854a2ac0 (1) 1.png') }}" alt="">
                    <h4>RT-Blogs</h4>
                </a>
                <img src="{{ Vite::asset('resources/images/Search.svg') }}" class="icon-show-search" alt="">
            </div>
            <div class="header-desktop">
                <div class="header-left">    
                    <a href="{{ route('blogs.home') }}" class="logo-header">
                        <img src="{{ Vite::asset('resources/images/Group 155.png') }}" alt="">
                    </a>
                    <form action="{{ route('blogs.search') }}" method="GET" class="search-header">
                        <input type="text" name="data"
                            @if (isset($request) && $request->has('data'))
                                value="{{ $request->input('data') }}" 
                            @else 
                                placeholder="Search blog" 
                            @endif 
                        >
                        <button><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </div>
                <div class="header-right">
                    <div class="header-tag">
                        @if (Route::is("blogs.home"))
                            <a class="active" href="{{ route('blogs.home') }}">Top</a>
                        @else
                            <a href="{{ route('blogs.home') }}">Top</a>
                        @endif
                        @if (Auth::user() && Route::is("view.create.blog"))
                            <a class="active" href="{{ route('view.create.blog') }}">Create Blog</a>
                        @elseif (Auth::user())
                            <a href="{{ route('view.create.blog') }}">Create Blog</a>
                        @endif
                    </div>
                    <div class="header-account">
                        @if (Auth::user())
                            <a href="#">{{ Auth::user()->user_name }}</a>
                            <i class="fa-regular fa-circle-user">
                                <div class="connect-menu"></div>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <ul>
                                        <li><a href="#">My blogs</a></li>
                                        <li><button type='submit'>Log out</button></li>
                                    </ul>
                                </form>
                            </i>
                        @else
                            <a href="{{ route('view.login') }}">Login</a>
                            <a href="{{ route('view.register') }}">Sign up</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>   
    </div>
    <div class="search-mobile">
        <div class="modal"></div>
        <div class="layout">
            <div class="logo-header">
                <img src="{{ Vite::asset('resources/images/Group 155.png') }}" alt="">
            </div>
            <form action="{{ route('blogs.search') }}" method="GET" class="search-header">
                <input type="text" name="data"
                    @if (isset($request) && $request->has('data'))
                        value="{{ $request->input('data') }}" 
                    @else 
                        placeholder="Search blog"
                    @endif 
                >
                <button><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
            <i class="fa-solid fa-xmark icon-close-menu"></i>
        </div>
    </div>
    <div class="menu-mobile">
        <div class="modal"></div>
        <div class="layout">
            <div class="logo-header">
                <img src="{{ Vite::asset('resources/images/Group 155.png') }}" alt="">
            </div>
            <div class="header-right">
                <div class="header-right-item">
                    @if(Route::is("blogs.home"))
                        <a class="active" href="{{ route('blogs.home') }}">Top</a>
                    @else
                        <a href="{{ route('blogs.home') }}">Top</a>
                    @endif
                </div>
                @if (Auth::user())
                    <div class="header-right-item">
                        <a @if(Route::is("view.create.blog")) class="active" @endif href="{{ route('view.create.blog') }}">Create Blog</a>
                    </div>
                    <div class="header-right-item">
                        <a href="#">My Blogs</a>
                    </div>
                    <div class="header-right-item">
                        <a href="#">{{ Auth::user()->user_name }}</a>
                    </div>
                    <div class="header-right-item">
                        <a href="#">Change Password</a>
                    </div>
                    <div class="header-right-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <label for="btn-logout">Logout</label>
                            <button hidden id="btn-logout" type='submit'>Log out</button>
                        </form>
                    </div>
                @else
                    <div class="header-right-item">
                        <a href="{{ route('view.login') }}">Login</a>
                    </div>
                    <div class="header-right-item">
                        <a href="{{ route('view.register') }}">Sign up</a>
                    </div>
                @endif
            </div>
            <i class="fa-solid fa-xmark icon-close-menu"></i>
        </div>
    </div>
    <div class="body">
        <div class="notification">
            @include('layouts.notification')
        </div>
        @yield('content')
    </div>
    <footer>
        <p>Copyright 2022. Made by Regit JSC</p>
    </footer>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
</body>
</html>
