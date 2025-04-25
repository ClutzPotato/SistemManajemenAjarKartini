@extends('layouts.studentdefault')

    @section('content')
                    
    <!-- Content Header (Page header) -->
  <div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-light">{{ $subject->subject_name }} - Materials</h1>
      </div>
    </div>
  </div>
</div>

<br>
    <div class="content">
  <div class="container-fluid">
    <div class="row">
      @if($materials->isEmpty())
        <div class="col-12">
          <div class="alert alert-info" role="alert">
            No materials in the subject yet.
          </div>
        </div>
      @else
        @foreach($materials as $material)
          <div class="col-md-4">
            <div class="card elevation-3">
              <div class="card-header">
                <h5 class="card-title">{{ $material->title }}</h5>
              </div>
              <div class="card-body">
                <a href="{{ route('student.materials.show', $material->id) }}" class="btn btn-primary">View Material</a>
              </div>
            </div>
          </div>
        @endforeach
      @endif
    </div>
  </div>
</div>

@endsection