<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/png" href="{{ Vite::asset('resources/images/LogoRegit.png') }}"/>
    <title>{{ __('app.name_website') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ Vite::asset('resources/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ Vite::asset('resources/css/adminlte.css') }}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="{{ Vite::asset('resources/js/adminlte.js') }}"></script>
    @vite(['resources/scss/admin.scss'])
    @vite(['resources/js/setup.js'])
  </head>
  <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
          <li class="nav-item">
              <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                <i class="fa-solid fa-bars"></i>
              </a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
              <a href="{{ route('admin.dashboard') }}" class="nav-link">{{ __('admin.content_header_manager') }}</a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
              <a href="{{ route('blogs.home') }}" class="nav-link">{{ __('admin.content_header_home') }}</a>
          </li>
        </ul>
      </nav>
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="#" class="brand-link">
            <img src="{{ Vite::asset('resources/images/LogoRegit.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: 0.8"/>
            <span class="brand-text font-weight-light">{{ __('app.name_website') }}</span>
        </a>
        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ asset('storage/'.Auth::user()->avatar) }}" class="img-circle elevation-2" alt="User Image" />
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{ Auth::user()->user_name }}</a>
                </div>
            </div>
            <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" >
                <li class="nav-item">
                  <a href="{{ route('admin.dashboard') }}"  
                    @if (Route::is('admin.dashboard')) 
                      class="active nav-link" 
                    @else 
                      class="nav-link" 
                    @endif
                  >
                    <i class="fa-solid fa-house"></i>
                    <p>{{ __('admin.navbar_dashboard') }}</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('admin.user.index') }}" 
                    @if (Route::is('admin.user.index')) 
                      class="active nav-link" 
                    @else 
                      class="nav-link" 
                    @endif
                  >
                    <i class="fa-solid fa-users"></i>
                    <p>{{ __('admin.navbar_user') }}</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('admin.blog.index') }}" 
                    @if (Route::is('admin.blog.index')) 
                      class="active nav-link" 
                    @else 
                      class="nav-link" 
                    @endif
                  >
                    <i class="fa-solid fa-blog"></i>
                    <p>{{ __('admin.navbar_blog') }}</p>
                  </a>
                </li>
              </ul>
            </nav>
        </div>
      </aside>
      <div class="content-wrapper">
        <div class="notification">
          @include('layouts.notification')
        </div>
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                @yield('title_page')
              </div>
            </div>
          </div>
        </section>
        @yield("content")
      </div>
    </div>
  </body>
</html>
