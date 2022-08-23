<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Scripts -->
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
<div id="app">

  <header class="header text-center">
    <h1 class="blog-name pt-lg-4 mb-0"><a class="no-text-decoration" href="{{ url('/') }}">Tshepiso's Blog</a></h1>

    <nav class="navbar navbar-expand-lg navbar-dark">

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div id="navigation" class="collapse navbar-collapse flex-column">
        <div class="profile-section pt-3 pt-lg-0">
          <img class="profile-image mb-3 rounded-circle mx-auto" src="storage/profile/me.jpeg" alt="image">

          <ul class="navbar-nav flex-column text-start">
            <!-- Authentication Links -->
            @guest
              @if (Route::has('login'))
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
              @endif

              @if (Route::has('register'))
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
              @endif
            @else
              <li class="nav-item">
                <a class="nav-link" href="{{ route('home') }}">{{ __('Dashboard') }}</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('posts.create') }}">{{ __('New Post') }}</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('category.create') }}">{{ __('New Category') }}</a>
              </li>
              <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  {{ Auth::user()->name }}
                </a>

                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{{ route('logout') }}"
                     onclick="event.preventDefault();
                                                                   document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                  </form>
                </div>
              </li>
            @endguest
          </ul>

        </div>
      </div>
    </nav>
  </header>

  <main class="main-wrapper">

    @include('layouts.alerts')
    @yield('content')
  </main>
</div>
</body>
</html>
