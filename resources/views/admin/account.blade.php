@extends('layouts.admindefault')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Account</h1>
      </div><!-- /.col -->

    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
  <div class="container-fluid">
  @if(session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif
    @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                         <li>{{ $error }}</li>
                             @endforeach
                        </ul>
            </div>
        @endif
        
    <div class="row">
      <div class="card">
        <div class="card-header">
          <h5 class="m-0">Account Information</h5>
        </div>
        <div class="card-body">
          <h6 class="card-title">Name: {{ Auth::user()->name }}</h6>  
        <br>
        <h6 class="card-title">Role: {{ Auth::user()->role }}</h6>  
        <br>
        <h6 class="card-title">Email {{ Auth::user()->email }}</h6>  
        <br>
        <div>
          <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editPassword">Change Password</button>
          <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editUsername">Change Name</button>
        </div>
      </div>
    </div>

    <!-- Edit Password Modal -->
    <div class="modal fade" id="editPassword" tabindex="-1" role="dialog" aria-labelledby="editPasswordLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editPasswordLabel">Edit Password</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{ route('change.password') }}" method="POST">
              @csrf
              <div class="form-group">
                <label for="current_password">Current Password:</label>
                <input type="password" class="form-control" id="current_password" name="current_password" required>
              </div>
              <div class="form-group">
                <label for="new_password">New Password:</label>
                <input type="password" class="form-control" id="new_password" name="new_password" required>
              </div>
              <div class="form-group">
                <label for="new_password_confirmation">Confirm New Password:</label>
                <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
              </div>
              <button type="submit" class="btn btn-primary">Change Password</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- End Edit Password Modal -->

        <!-- Edit Username Modal -->
        <div class="modal fade" id="editUsername" tabindex="-1" role="dialog" aria-labelledby="editUsernameLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editUsernameLabel">Edit Username</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{ route('change.username') }}" method="POST">
              @csrf
              <div class="form-group">
                <label for="new_username">New Username:</label>
                <input type="text" class="form-control" id="new_username" name="new_username" required>
              </div>
              <button type="submit" class="btn btn-primary">Change Username</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- End Edit Username Modal -->
    
  </div>
</div>

@endsection
