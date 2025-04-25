@extends('layouts.teacherdefault')

    @section('content')



    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-light">Subject</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
          <h5 class="m-0 text-light">Search Subject</h5>
          <form class="form-inline " method="GET" action="{{ route('teacher.subjects.index') }}">
          <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" name="query" value="{{ request()->input('query') }}" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
              </button>
              <a class="btn btn-navbar" href="{{ route('teacher.subjects.index') }}">
                <i class="fas fa-times"></i>
              </a>
            </div>
          </div>
        </form>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
      <div class="row">
            @foreach($subjects as $subject)
                <div class="col-md-4">
                    <div class="card elevation-3">
                      <div class="card-header">
                      <h5 class="card-title">{{ $subject->subject_name }}</h5>
                        </div>
                        <div class="card-body">
                           
                            <p class="card-text">
                            {!! nl2br(e($subject->subject_description )) !!}
                            </p>
                            <a href="{{ route('teacher.materials.index', $subject->id) }}" class="btn btn-primary">View Subject</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="pagination-links">
            {{ $subjects->links() }}
          </div>
      </div><!-- /.container-fluid -->
    </div>

@endsection