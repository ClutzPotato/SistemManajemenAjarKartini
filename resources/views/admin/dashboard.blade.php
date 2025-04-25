@extends('layouts.admindefault')

    @section('content')
                    
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-4">
            <div class="card">
            <div class="card-header">
                <h5 class="m-0">Users</h5>
              </div>
              <div class="card-body">

                <p class="card-text">
                <h5 class="m-0">There is currently {{ $users->count() }} amount of users</h5>
                </p>

              </div>
              <div class="card-footer">
              <a href="{{ url('admin/user') }}"><button type="button" class="btn btn-primary container-fluid">Go to table</button></a>
              </div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="card">
            <div class="card-header">
                <h5 class="m-0">Class</h5>
              </div>
              <div class="card-body">

                <p class="card-text">
                <h5 class="m-0">There is currently {{ $classes->count() }} amount of class</h5>
                </p>

              </div>
              <div class="card-footer">
              <a href="{{ url('admin/class') }}"><button type="button" class="btn btn-primary container-fluid">Go to table</button></a>
              </div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="card">
            <div class="card-header">
                <h5 class="m-0">Subject</h5>
              </div>
              <div class="card-body">

                <p class="card-text">
                <h5 class="m-0">There is currently {{ $subjects->count() }} amount of subjects</h5>
                </p>

              </div>
              <div class="card-footer">
              <a href="{{ url('admin/subject') }}"><button type="button" class="btn btn-primary container-fluid">Go to table</button></a>
              </div>
            </div>
          </div>
        </div>
        <div class="row">

        <div class="col-lg-4">
            <div class="card">
            <div class="card-header">
                <h5 class="m-0">Material</h5>
              </div>
              <div class="card-body">

                <p class="card-text">
                <h5 class="m-0">There is currently {{ $materials->count() }} amount of materials</h5>
                </p>

              </div>
              <div class="card-footer">
              <a href="{{ url('admin/material') }}"><button type="button" class="btn btn-primary container-fluid">Go to table</button></a>
              </div>
            </div>
          </div>

        </div>
        </div>
      </div><!-- /.container-fluid -->

@endsection