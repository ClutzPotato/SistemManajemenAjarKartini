@extends('layouts.default')

@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Source+Serif+4:ital,opsz,wght@0,8..60,200..900;1,8..60,200..900&display=swap" rel="stylesheet">

<style>
    .titlefont{
        font-family: "Source Serif 4", serif;
        font-optical-sizing: auto;
        font-weight: 500;
        font-style: normal;
        font-size: x-large;
        text-align: center;
    }
    .grad1 {
          background-image: linear-gradient( #08270B , #25BE36);
        }
</style>
<div class="container-fluid grad1">
    <div class="row justify-content-center align-items-center">
        <!-- Image Section -->
        <div class="col-md-8 p-0">
            <!-- You can replace the src attribute with the path to your school image -->
            <img src="{{ asset('assets/dist/img/schoolhomelogin.png') }}" alt="School Image" class="img-fluid vh-100 w-100">
        </div>
        <!-- Card Section -->
        <div class="col-md-4 p-4">
        <center><img src="{{asset("assets/dist/img/LogoSekolah.jpg")}}" alt="Logo SMAKartini" class="img-thumbnail img-circle elevation-3" style="width: 50%;"></center>
        <div class="row">
        <p class="text-uppercase titlefont" style="text-shadow: 1px black;">Sistem Materi Ajar SMA Kartini Batam</p>
        </div>
        <div class="row">
            <div class="card elevation-4">
                <div class="card-header">{{ __('Login Type') }}</div>
                <div class="card-body">
                    <div class="row">
                        <a href="{{ route('loginstudent') }}" class="btn btn-primary btn-block mb-3 kartiniblue">Student Login</a>
                    </div>
                    <div class="row">
                        <a href="{{ route('loginteacher') }}" class="btn btn-primary btn-block mb-3 kartiniblue">Teacher Login</a>
                    </div>
                    <!-- Registration if needed 
                    <div class="row">
                        <a href="{{ route('register') }}" class="btn btn-outline-primary btn-block">Register</a>
                    </div>
                    -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
