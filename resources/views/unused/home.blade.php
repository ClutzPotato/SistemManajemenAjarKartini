@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (Auth::check())
                        @if (Auth::user()->role == 'admin')
                            <script>
                                window.location.href = "/admin/dashboard"; 
                            </script>
                        @endif
                        {{ __('You are logged in!') }}
                    @else
                        <div class="alert alert-danger" role="alert">
                            Please login to see the site.
                        </div>
                        <script>
                            setTimeout(function() {
                                window.location.href = "{{ route('homelogin') }}";
                            }, 3000); // Redirect after 3 seconds
                        </script>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection