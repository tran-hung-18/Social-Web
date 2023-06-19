@extends('layouts.app')

@section('content')
    <div class="search-mobile">
        <div class="modal"></div>
        <div class="layout">
            <div class="logo-header">
                <img src="{{ Vite::asset('resources/images/Group 155.png') }}" alt="">
            </div>
            <div class="search-header">
                <input type="text" placeholder="Search blog">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
            <i class="fa-solid fa-xmark icon-close-search" onclick="searchMobile(0)"></i>
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
                    <button>Top</button>
                </div>
                <div class="header-right-item">
                    <p>Create Blog</p>
                </div>
                <div class="header-right-item">
                    @if (Auth::user())
                    <i class="fa-regular fa-circle-user"> </i>
                        <p>{{ Auth::user()->user_name }}</p>
                    @else
                        <a href="{{ route('view-login') }}">Login</a>
                        <a href="{{ route('view-register') }}">Sign up</a>
                    @endif
                </div>
            </div>
            <i class="fa-solid fa-xmark icon-close-menu" onclick="menuMobile(0)"></i>
        </div>
    </div>
    <div class="body">
        <div class="img-title">
            <img src="{{ Vite::asset('resources/images/laptop-in-modern-office 1.png') }}" alt="">
        </div>
        <div class="list-blog">
            <div class="title">
                <h1>List Blog</h1>
                <select class="form-select" aria-label="Default select example">
                    <option selected>Category</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>
            <div class="all-item">
                <div class="item-blog">
                    <div class="item-blog-img">
                        <img src="{{ Vite::asset('resources/images/Rectangle 80.png') }}" alt="">
                    </div>
                    <div class="item-blog-content">
                        <div class="info">
                            <div class="author">
                                <img src="{{ Vite::asset('resources/images/Group 25.svg') }}" alt="">
                                <p>Jimmy Nguyễn</p>
                            </div>
                            <div class="time">
                                <img src="{{ Vite::asset('resources/images/Group 38.svg') }}" alt="">
                                <p>3 mins ago</p>
                            </div>
                        </div>
                        <div class="text-detail">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                            <p>Lorem ipsum dolor sit amet, consectetur ipsum linum amataki hulanjfh bfueodap fiefhief...</p>
                        </div>
                        <div class="text-link">
                            <button class="btn btn-details">
                                <p>Read more</p> 
                                <svg width="18" height="8" viewBox="0 0 20 10" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19 5H1M19 5L15 9M19 5L15 1" stroke="#C40000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="item-blog">
                    <div class="item-blog-img">
                        <img src="{{ Vite::asset('resources/images/Rectangle 80.png') }}" alt="">
                    </div>
                    <div class="item-blog-content">
                        <div class="info">
                            <div class="author">
                                <img src="{{ Vite::asset('resources/images/Group 25.svg') }}" alt="">
                                <p>Jimmy Nguyễn</p>
                            </div>
                            <div class="time">
                                <img src="{{ Vite::asset('resources/images/Group 38.svg') }}" alt="">
                                <p>3 mins ago</p>
                            </div>
                        </div>
                        <div class="text-detail">
                            <p class="title-item">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                            <p>Lorem ipsum dolor sit amet, consectetur ipsum linum amataki hulanjfh bfueodap fiefhief...</p>
                        </div>
                        <div class="text-link">
                            <button class="btn btn-details">
                                <p>Read more</p>
                                <svg width="18" height="8" viewBox="0 0 20 10" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19 5H1M19 5L15 9M19 5L15 1" stroke="#C40000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="item-blog">
                    <div class="item-blog-img">
                        <img src="{{ Vite::asset('resources/images/Rectangle 80.png') }}" alt="">
                    </div>
                    <div class="item-blog-content">
                        <div class="info">
                            <div class="author">
                                <img src="{{ Vite::asset('resources/images/Group 25.svg') }}" alt="">
                                <p>Jimmy Nguyễn</p>
                            </div>
                            <div class="time">
                                <img src="{{ Vite::asset('resources/images/Group 38.svg') }}" alt="">
                                <p>3 mins ago</p>
                            </div>
                        </div>
                        <div class="text-detail">
                            <p class="title-item">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                            <p>Lorem ipsum dolor sit amet, consectetur ipsum linum amataki hulanjfh bfueodap fiefhief...</p>
                        </div>
                        <div class="text-link">
                            <button class="btn btn-details">
                                <p>Read more</p>
                                <svg width="18" height="8" viewBox="0 0 20 10" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19 5H1M19 5L15 9M19 5L15 1" stroke="#C40000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="item-blog">
                    <div class="item-blog-img">
                        <img src="{{ Vite::asset('resources/images/Rectangle 80.png') }}" alt="">
                    </div>
                    <div class="item-blog-content">
                        <div class="info">
                            <div class="author">
                                <img src="{{ Vite::asset('resources/images/Group 25.svg') }}" alt="">
                                <p>Jimmy Nguyễn</p>
                            </div>
                            <div class="time">
                                <img src="{{ Vite::asset('resources/images/Group 38.svg') }}" alt="">
                                <p>3 mins ago</p>
                            </div>
                        </div>
                        <div class="text-detail">
                            <p class="title-item">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                            <p>Lorem ipsum dolor sit amet, consectetur ipsum linum amataki hulanjfh bfueodap fiefhief...</p>
                        </div>
                        <div class="text-link">
                            <button class="btn btn-details">
                                <p>Read more</p>
                                <svg width="18" height="8" viewBox="0 0 20 10" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19 5H1M19 5L15 9M19 5L15 1" stroke="#C40000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="item-blog">
                    <div class="item-blog-img">
                        <img src="{{ Vite::asset('resources/images/Rectangle 80.png') }}" alt="">
                    </div>
                    <div class="item-blog-content">
                        <div class="info">
                            <div class="author">
                                <img src="{{ Vite::asset('resources/images/Group 25.svg') }}" alt="">
                                <p>Jimmy Nguyễn</p>
                            </div>
                            <div class="time">
                                <img src="{{ Vite::asset('resources/images/Group 38.svg') }}" alt="">
                                <p>3 mins ago</p>
                            </div>
                        </div>
                        <div class="text-detail">
                            <p class="title-item">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                            <p>Lorem ipsum dolor sit amet, consectetur ipsum linum amataki hulanjfh bfueodap fiefhief...</p>
                        </div>
                        <div class="text-link">
                            <button class="btn btn-details">
                                <p>Read more</p>
                                <svg width="18" height="8" viewBox="0 0 20 10" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19 5H1M19 5L15 9M19 5L15 1" stroke="#C40000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="item-blog">
                    <div class="item-blog-img">
                        <img src="{{ Vite::asset('resources/images/Rectangle 80.png') }}" alt="">
                    </div>
                    <div class="item-blog-content">
                        <div class="info">
                            <div class="author">
                                <img src="{{ Vite::asset('resources/images/Group 25.svg') }}" alt="">
                                <p>Jimmy Nguyễn</p>
                            </div>
                            <div class="time">
                                <img src="{{ Vite::asset('resources/images/Group 38.svg') }}" alt="">
                                <p>3 mins ago</p>
                            </div>
                        </div>
                        <div class="text-detail">
                            <p class="title-item">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                            <p>Lorem ipsum dolor sit amet, consectetur ipsum linum amataki hulanjfh bfueodap fiefhief...</p>
                        </div>
                        <div class="text-link">
                            <button class="btn btn-details">
                                <p>Read more</p>
                                <svg width="18" height="8" viewBox="0 0 20 10" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19 5H1M19 5L15 9M19 5L15 1" stroke="#C40000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="item-blog">
                    <div class="item-blog-img">
                        <img src="{{ Vite::asset('resources/images/Rectangle 80.png') }}" alt="">
                    </div>
                    <div class="item-blog-content">
                        <div class="info">
                            <div class="author">
                                <img src="{{ Vite::asset('resources/images/Group 25.svg') }}" alt="">
                                <p>Jimmy Nguyễn</p>
                            </div>
                            <div class="time">
                                <img src="{{ Vite::asset('resources/images/Group 38.svg') }}" alt="">
                                <p>3 mins ago</p>
                            </div>
                        </div>
                        <div class="text-detail">
                            <p class="title-item">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                            <p>Lorem ipsum dolor sit amet, consectetur ipsum linum amataki hulanjfh bfueodap fiefhief...</p>
                        </div>
                        <div class="text-link">
                            <button class="btn btn-details">
                                <p>Read more</p>
                                <svg width="18" height="8" viewBox="0 0 20 10" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19 5H1M19 5L15 9M19 5L15 1" stroke="#C40000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="item-blog">
                    <div class="item-blog-img">
                        <img src="{{ Vite::asset('resources/images/Rectangle 80.png') }}" alt="">
                    </div>
                    <div class="item-blog-content">
                        <div class="info">
                            <div class="author">
                                <img src="{{ Vite::asset('resources/images/Group 25.svg') }}" alt="">
                                <p>Jimmy Nguyễn</p>
                            </div>
                            <div class="time">
                                <img src="{{ Vite::asset('resources/images/Group 38.svg') }}" alt="">
                                <p>3 mins ago</p>
                            </div>
                        </div>
                        <div class="text-detail">
                            <p class="title-item">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                            <p>Lorem ipsum dolor sit amet, consectetur ipsum linum amataki hulanjfh bfueodap fiefhief...</p>
                        </div>
                        <div class="text-link">
                            <button class="btn btn-details">
                                <p>Read more</p>
                                <svg width="18" height="8" viewBox="0 0 20 10" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19 5H1M19 5L15 9M19 5L15 1" stroke="#C40000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="item-blog">
                    <div class="item-blog-img">
                        <img src="{{ Vite::asset('resources/images/Rectangle 80.png') }}" alt="">
                    </div>
                    <div class="item-blog-content">
                        <div class="info">
                            <div class="author">
                                <img src="{{ Vite::asset('resources/images/Group 25.svg') }}" alt="">
                                <p>Jimmy Nguyễn</p>
                            </div>
                            <div class="time">
                                <img src="{{ Vite::asset('resources/images/Group 38.svg') }}" alt="">
                                <p>3 mins ago</p>
                            </div>
                        </div>
                        <div class="text-detail">
                            <p class="title-item">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                            <p>Lorem ipsum dolor sit amet, consectetur ipsum linum amataki hulanjfh bfueodap fiefhief...</p>
                        </div>
                        <div class="text-link">
                            <button class="btn btn-details">
                                <p>Read more</p>
                                <svg width="18" height="8" viewBox="0 0 20 10" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19 5H1M19 5L15 9M19 5L15 1" stroke="#C40000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <ul class="paging">
                <li>
                    <i class="fa-solid fa-angle-left"></i>
                </li>
                <li><a href="">1</a></li>
                <li><a href="">2</a></li>
                <li><a href="">3</a></li>
                <li><a href="">4</a></li>
                <li><a href="">5</a></li>
                <li><a href="">6</a></li>
                <li>
                    <i class="fa-solid fa-angle-right"></i>
                </li>
            </ul>
        </div>
    </div>
@endsection
