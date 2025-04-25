@extends('layouts.teacherdefault')

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
<div class="container-fluid">
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#addMaterialModal">Add New Material</button>
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
                <a href="{{ route('teacher.materials.show', $material->id) }}" class="btn btn-primary">View Material</a>
              </div>
            </div>
          </div>
        @endforeach
      @endif
    </div>
  </div>
</div>

<!-- Modal for Adding Material -->
<div class="modal fade" id="addMaterialModal" tabindex="-1" role="dialog" aria-labelledby="addMaterialModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addMaterialModalLabel">Add New Material</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('material.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="subject_id">Subject:</label>
                        <select class="form-control" id="subject_id" name="subject_id" required>
                                <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="material_title" class="col-form-label">Material Title:</label>
                        <input type="text" class="form-control" id="material_title" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="material_type">Material Type:</label>
                        <select class="form-control" id="material_type" name="type" required>
                            <option value="normal">Normal</option>
                            <option value="assignment">Assignment</option>
                            <option value="quiz">Quiz</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="material_description">Material Description</label>
                        <textarea class="form-control" id="material_description" name="description" rows="5"
                            required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Material</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection