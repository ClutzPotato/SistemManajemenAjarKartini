@extends('layouts.teacherdefault')

    @section('content')
                    
    <!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-light">{{ $material->title }}</h1>
      </div>
    </div>

    <div class="row mb-2">
    <div class="col-1">
<button type="button" class="btn btn-warning" data-toggle="modal"
                                            data-target="#editMaterialModal" data-id="{{ $material->id }}"
                                            data-subject_id="{{ $material->subject_id }}"
                                            data-title="{{ $material->title }}"
                                            data-type="{{ $material->type }}"
                                            data-description="{{ $material->description }}">
                                            Edit
                                        </button>
    </div>
    <div class="col-1">
                                        <form action="{{ route('material.destroy', $material->id) }}" method="POST"
                                            onsubmit="return confirmDelete()">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                        </div> </div></div>
</div>
<br>
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
    <!-- /.content-header -->

<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card elevation-3">
          <div class="card-header">
            <h5 class="card-title">Description</h5>
          </div>
          <div class="card-body">
          <p>{!! nl2br(e($material->description)) !!}</p>

            <h3>Attachments:</h3>
            @foreach ($attachments as $attachment)
          <div class="row p-1">
          <div class="col-md-4">
            <a href="{{ asset('storage/' . $attachment->file_path) }}" target="_blank">{{ $attachment->file_name }}</a>
            </div>
            <div class="col-md-4">
              <form action="{{ route('file_attachments.destroy', $attachment->attachment_id) }}" method="POST" onsubmit="return confirmDelete()">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></butto>
              </form>
              </div>
          </div>
            @endforeach
            <br>
          <div>
            <button type="button" class="btn btn-success" data-toggle="modal"
                            data-target="#addAttachmentModal">Add New File Attachment</button>
          </div>
          </div>
          @if ($material->type == 'quiz')
          <div class="card-footer">
          <a href="{{ route('quiz.create', $material->id) }}"><button class="btn btn-primary container-fluid">Make Quiz</button></a>
          </div>
          @endif
        </div>
        @if ($material->type == 'quiz' && $quiz)
          <div class="card-footer">
            <a href="{{ route('quiz.show', $quiz->id) }}"><button class="btn btn-primary container-fluid">Show Quiz</button></a>
          </div>
        @endif
        @if ($material->type == 'quiz')
        <div class="card elevation-3">
          <div class="card-header">
            <h5 class="card-title">Quiz Submission</h5>
          </div>
          <div class="card-body">
          <table id="example1" class="table table-bordered mt-3">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Quiz Title</th>
                                    <th>Student Name</th>
                                    <th>Answer</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($quizsubmissions as $quiz)
                                <tr>
                                    <td>{{ $quiz->id }}</td>
                                    <td>{{ $quiz->quiz->title }}</td>
                                    <td>{{ $quiz->student->name }}</td>
                                    <td><a href="{{ route('teacher.quiz_submission.show', $quiz->id) }}"><button class="btn btn-primary">Show Answer</button></a></td>
                                    <td>
                                        <form action="{{ route('quizsubmission.destroy', $quiz->id ) }}" method="POST"
                                            onsubmit="return confirmDelete()">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
          </div>
        </div>
          @endif
        
@if ($material->type == 'assignment')
        <div class="card elevation-3">
          <div class="card-header">
            <h5 class="card-title">Assignment Submission</h5>
          </div>
          <div class="card-body">
          <table id="example" class="table table-bordered mt-3">
                            <thead>
                                <tr>
                                    <th>Student Name</th>
                                    <th>File Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($assignments as $assignment)
                                <tr>
                                    <td>{{ $assignment->student->name }}</td>
                                    <td><a href="{{ asset('storage/' . $assignment->file_path) }}" target="_blank">{{ $assignment->file_name }}</a></td>
                                    
                                    <td>
                                    <form action="{{ route('assignments.destroy', $assignment->id) }}" method="POST" onsubmit="return confirmDelete()">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></butto>
              </form>
                                    </td>
                                @endforeach
                            </tbody>
                        </table>
          </div>
        </div>
        @endif

        
      </div>
    </div>
  </div>
</div>

<!-- jQuery -->
<script src="{{asset("/assets/dist/js/jquery-3.5.1.js")}}"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>

<!-- Modal for Adding File Attachment -->
<div class="modal fade" id="addAttachmentModal" tabindex="-1" role="dialog" aria-labelledby="addAttachmentModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAttachmentModalLabel">Add New File Attachment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('file_attachments.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="material_id">Material:</label>
                        <select class="form-control" id="material_id" name="material_id" required>
                        <option value="{{ $material->id }}">{{ $material->subject->subject_name }} - {{ $material->title }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="file_name" class="col-form-label">File Name: (Max File size: 2048kb)</label>
                        <input type="file" class="form-control" id="file" name="file" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add File Attachment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Single Edit Material Modal -->
<div class="modal fade" id="editMaterialModal" tabindex="-1" role="dialog" aria-labelledby="editMaterialModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editMaterialModalLabel">Edit Material</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editMaterialForm" method="POST" action="">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="subject_id">Subject:</label>
                        <select class="form-control" id="subject_id" name="subject_id" required>
                                <option value="{{ $material->subject_id }}">{{ $material->subject->subject_name }}</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="material_title" class="form-label">Material Title</label>
                        <input type="text" class="form-control" id="material_title" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="material_type">Material Type:</label>
                        <select class="form-control" id="material_type" name="type" required>
                            <option value="{{ $material->type }}">{{ $material->type }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="material_description">Material Description</label>
                        <textarea class="form-control" id="material_description" name="description" rows="5"
                            required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
    $('#example').DataTable({
    });
});
$(document).ready(function() {
    $('#example1').DataTable({
    });
});
$(document).ready(function() {
        $('#editMaterialModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var id = button.data('id');
            var subject_id = button.data('subject_id');
            var title = button.data('title');
            var type = button.data('type');
            var description = button.data('description');

            var modal = $(this);
            modal.find('#subject_id').val(subject_id);
            modal.find('#material_title').val(title);
            modal.find('#material_type').val(type);
            modal.find('#material_description').val(description);
            modal.find('#editMaterialForm').attr('action','/admin/material/' + id);
        });
    });

    function confirmDelete() {
        return confirm('Are you sure you want to delete this data?');
    }
</script>
@endsection