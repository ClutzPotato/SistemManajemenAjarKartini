<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
     <!-- Favicon -->
     <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}" />
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset("/assets/dist/css/bootstrap.min.css")}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('assets/dist/css/adminlte.min.css')}}">
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap Bundle with Popper -->
    <script src="{{asset("/assets/plugins/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset("assets/dist/js/adminlte.min.js")}}"></script>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<style>
    .smaller-image {
    width: 75px;
    height: auto;
}
.bgimage1 {
        background-image: url('{{ asset("assets/image/bgwallpaper.jpg") }}');
        background-color: #cccccc;
        background-size: cover;
        background-repeat: no-repeat;
        }
        .bgimage2 {
        background-image: url('{{ asset("assets/image/Bgwalp.jpg") }}');
        background-color: #cccccc;
        background-size: cover;
        background-repeat: no-repeat;
        }

        .grad1 {
          background-image: linear-gradient(to right, #08270B , #25BE36);
        }
        .grad2 {
          background-image: linear-gradient(to bottom right,#08270B , #25BE36 );
        }
        .activegreen {background-color: #168722;
                color: #fff;
              }
        .kartiniblue {
            color: #2982e0;
        }
</style>
<body class="bgimage1">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm grad1">
            <div class="container">
            <img src="assets/dist/img/LogoSekolah.jpg" alt="Logo SMA Kartini" class="smaller-image p-2 img-circle elevation-1">
                <a class="navbar-brand p-2 text-light" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <!-- Add left side links if needed -->
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @if (Auth::check())
                        @php
                            $userRole = Auth::user()->role;
                        @endphp

                        @if ($userRole == 'student')
                            <script>window.location = "{{ url('/student/dashboard') }}";</script>
                        @elseif ($userRole == 'teacher')
                            <script>window.location = "{{ url('/teacher/dashboard') }}";</script>
                        @elseif ($userRole == 'admin')
                            <script>window.location = "{{ url('/admin/dashboard') }}";</script>
                        @endif
                        @endif


                        @guest
                        <!-- resistrations links if not logged in 
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-light" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        -->
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap Bundle with Popper -->
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
