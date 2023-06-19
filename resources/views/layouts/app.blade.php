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
    @vite(['resources/scss/app.scss'])
    @vite(['resources/js/home.js'])
</head>
<body>
    <script>
        function menuMobile(value){
            document.querySelector('.menu-mobile').style.width = `${value}%`;
        }
        function searchMobile(value){
            document.querySelector('.search-mobile').style.width = `${value}%`;
        }
    </script>
    <div class="header">
        <div class="container-header">
            <div class="header-mobile">
                <img src="{{ Vite::asset('resources/images/Vector.svg') }}" class="icon-show-menu" onclick="menuMobile(100)" alt="">
                <div class="logo-header">
                    <img src="{{ Vite::asset('resources/images/7d85462e-ed1f-4b7b-b617-ad57854a2ac0 (1) 1.png') }}" alt="">
                    <h4>RT-Blogs</h4>
                </div>
                <img src="{{ Vite::asset('resources/images/Search.svg') }}" class="icon-show-search" onclick="searchMobile(100)" alt="">
            </div>
            <div class="header-desktop">
                <div class="header-left">    
                    <div class="logo-header">
                        <img src="{{ Vite::asset('resources/images/Group 155.png') }}" alt="">
                    </div>
                    <div class="search-header">
                        <input type="text" placeholder="Search blog">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                </div>
                <div class="header-right">
                    <div class="header-tag">
                        <button>Top</button>
                        <p>Create Blog</p>
                    </div>
                    <div class="header-account">
                        @if (Auth::user())
                            <p>{{ Auth::user()->user_name }}</p>
                            <i class="fa-regular fa-circle-user">
                                <div class="connect-menu"></div>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <ul>
                                        <li><a href="">My blogs</a></li>
                                        <li><button type='submit'>Log out</button></li>
                                    </ul>
                                </form>
                            </i>
                        @else
                            <a href="{{ route('view-login') }}">Login</a>
                            <a href="{{ route('view-register') }}">Sign up</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>   
    </div>
    @yield('content')
    <footer>
        <p>Copyright 2022. Made by Regit JSC</p>
    </footer>
</body>
</html>
