@extends('layouts.studentdefault')

    @section('content')
                    
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-light">Dashboard for Students</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- /.col-md-6 -->
          <div class="col-lg-6">
            <div class="card elevation-3">
              <div class="card-header">
                <h5 class="m-0">Class Assigned</h5>
              </div>
              <div class="card-body">
                <h6 class="card-title">You are assigned to class {{Auth::user()->student->classmodel->class_name}} </h6>
              </div>
            </div>
          </div>
          <!-- /.col-md-6 -->

          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

@endsection