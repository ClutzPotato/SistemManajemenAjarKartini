@extends('layouts.studentdefault')

@section('content')
                    
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-light">{{ $material->title }}</h1>
      </div>
    </div>
  </div>
</div>
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
<br>
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
            </div>
            @endforeach
            <br>

          </div>


          
        </div>
        @if ($material->type === 'quiz')
        <div class="card elevation-3">
        <div class="card-header">
            <h5 class="card-title">Quiz</h5>
          </div>
        
        <div class="card-body">
        @if ($material->type == 'quiz' && $quiz)
          <div class="card-footer">
            <a href="{{ route('student.quiz.show', $quiz->id) }}"><button class="btn btn-success container-fluid">Start Quiz</button></a>
          </div>
        @else
        <div class="card-footer">
           <p>Quiz has not been made yet</p>
          </div>
        @endif
            </div>
        </div>
        @if ($material->type == 'quiz' && $quizsubmission)
          <div class="card-footer">
            <a href="{{ route('quiz_submission.show', $quizsubmission->id) }}"><button class="btn btn-success container-fluid">Show Your answer</button></a>
          </div>
        @endif

        @endif

        @if ($material->type === 'assignment')
        <div class="card elevation-3">
        <div class="card-header">
            <h5 class="card-title">Submit Assignments</h5>
          </div>
        
        <div class="card-body">
          Max file size: 2048KB, File type:pdf,doc,docx,zip,jpg,jpeg,png,gif
          <br>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addAttachmentModal">Submit assignment</button>
           

          <br>
            @if ($assignment)
            Assignment submitted: <a href="{{ asset('storage/' . $assignment->file_path) }}" target="_blank">{{ $assignment->file_name }}</a>
            @endif
            </div>
        </div>
        @endif

      </div>
    </div>
  </div>
</div>

<!-- Modal for Submitting Assignment -->
<div class="modal fade" id="addAttachmentModal" tabindex="-1" role="dialog" aria-labelledby="addAttachmentModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addAttachmentModalLabel">Submit Assignment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{ route('assignment_submissions.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <input type="hidden" name="material_id" value="{{ $material->id }}">
          <div class="form-group">
            <label for="file">Assignment File:</label>
            <input type="file" class="form-control" id="file" name="file" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit Assignment</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
    function confirmDelete() {
        return confirm('Are you sure you want to delete this data?');
    }
</script>
@endsection
