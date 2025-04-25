@extends('layouts.studentdefault')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-light">{{ $quiz->title }}</h1>
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
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card elevation-3">
          <div class="card-header">
            <h5 class="card-title">Quiz for {{ $material->title }}</h5>
          </div>
          <div class="card-body">
            <form method="POST" action="{{ route('quiz.submit', $quiz->id) }}">
              @csrf
              @foreach(json_decode($quiz->quiz_data) as $question)
                <div class="mb-3">
                  <h5>{{ $question->question }}</h5>
                  @if($question->type == 'choice')
                    @foreach($question->choices as $index => $choice)
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="answers[{{ $loop->parent->index }}]" id="choice_{{ $loop->parent->index }}_{{ $index }}" value="{{ $choice }}">
                        <label class="form-check-label" for="choice_{{ $loop->parent->index }}_{{ $index }}">
                          {{ $choice }}
                        </label>
                      </div>
                    @endforeach
                  @elseif($question->type == 'blank')
                    <input type="text" class="form-control" name="answers[{{ $loop->index }}]">
                  @endif
                </div>
              @endforeach
              <button type="submit" class="btn btn-primary">Submit Quiz</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
