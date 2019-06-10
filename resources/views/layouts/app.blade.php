<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:regular,bold">
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/fa.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/laracrud.css') }}">
    {{--  <link rel="stylesheet" href="{{ asset('../css/app.css') }}">  --}}

    <title>@yield('title') | {{ config('app.name') }}</title>
</head>
<body class="bg-light h-100">
        <nav class="navbar navbar-expand-md navbar-light bg-green shadow-sm">
                <div class="container">
                    <a class="navbar-brand text-dark " href="{{ url('/') }}">
                        <i class="fa fa-truck" aria-hidden="true"></i>
                        {{ config('app.name', 'Laravel') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                            @include('layouts.nav')

                            <li class="nav-item dropdown">
                                    <a href="#" id="userDropdown" class="nav-link dropdown-toggle text-dark text-uppercase" role="button" data-toggle="dropdown">
                                        {{ auth()->user()->name }}
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <button type="button" class="dropdown-item" data-modal="{{ route('profile') }}">Profile</button>
                                        <button type="button" class="dropdown-item" data-modal="{{ route('password') }}">Password</button>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item">Logout</button>
                                        </form>
                                    </div>
                                </li>

                                {{--  <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-dark text-uppercase" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>  --}}
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
    @yield('parent-content')

    <script src="{{ asset('/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/js/datatables.min.js') }}"></script>
    <script src="{{ asset('/js/laracrud.js') }}"></script>
    {{--  <script src="{{ asset('../js/app.js') }}"></script>  --}}
    @yield('scripts')
    @stack('scripts')
</body>
</html>
