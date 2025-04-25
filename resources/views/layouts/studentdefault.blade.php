<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>SMA Kartini Sistem Ajar</title>
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
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('assets/dist/css/adminlte.min.css')}}">
  <!-- DataTables CSS -->
  <link rel="stylesheet" href="{{ asset('assets/dist/css/dataTables.bootstrap4.min.css') }}">
    <style>
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
    </style>
    
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark navbar-light  grad1">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/homelogin" class="nav-link">Home</a>
      </li>
      <li>
      <a class="nav-link" href="{{ route('logout') }}"
      onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
      {{ __('Logout') }}
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
      @csrf
      </form>
        </li>

    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      
    <!-- Navbar Search 
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li> -->

      
      <!-- Notifications Dropdown Menu 
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>-->

      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4 bgimage1">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
    <span ><img src="{{asset("assets/dist/img/LogoSekolah.jpg")}}" alt="Logo SMAKartini" class="img-thumbnail img-circle elevation-3"></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="{{ route('student.account') }}" class="d-block">
              @if (auth()->check())
                        <div>
                        {{ auth()->user()->name }} 
                        </div>
                    @endif
                  </a>
        </div>
      </div>



<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="{{ url('student/dashboard') }}" class="nav-link {{ Request::is('student/dashboard') ? 'activegreen' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ url('student/subjects') }}" class="nav-link {{ Request::is('student/subjects*') ? 'activegreen' : '' }}">
                <i class="nav-icon fas fa-book-open"></i>
                <p>
                    Subjects
                </p>
            </a>
        </li>
    </ul>
</nav>
<!-- /.sidebar-menu -->

    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper bgimage2">
    
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (Auth::check())
                        @if (Auth::user()->role == 'student')
                            <script>
                                {{ __('You are logged in!') }}
                            </script>
                        @else
                        <div class="alert alert-danger" role="alert">
                            Please login as teacher to see this teacher page.
                        </div>
                        <script>
                            setTimeout(function() {
                                window.location.href = "{{ route('homelogin') }}";
                            }, 1000); // Redirect after 1 seconds
                        </script>
                        @endif
                    @else
                    <div class="alert alert-danger" role="alert">
                            Please login as teacher to see this teacher page.
                        </div>
                        <script>
                            setTimeout(function() {
                                window.location.href = "{{ route('homelogin') }}";
                            }, 1000); // Redirect after 1 seconds
                        </script>
                    @endif

    <div id="app">
        <main>
            @yield('content')
        </main>
    </div>
  </div>

<!-- jQuery -->
<script src="{{asset("/assets/dist/js/jquery-3.5.1.js")}}"></script>

<!-- Bootstrap Bundle with Popper -->
<script src="{{asset("/assets/plugins/bootstrap/js/bootstrap.bundle.min.js")}}"></script>

<!-- AdminLTE App -->
<script src="{{asset("assets/dist/js/adminlte.min.js")}}"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
    SMA Kartini Batam
    </div>
    <!-- Default to the left -->
    <strong>Copyright UIB2024.</strong> All rights reserved.
  </footer>

</div>
    
</body>
</html>
