@extends('layouts.teacherdefault')

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
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card elevation-3">
          <div class="card-header">
            <h5 class="card-title">Quiz for {{ $material->title }}</h5>
          </div>
          <div class="card-body">
            @foreach(json_decode($quiz->quiz_data) as $question)
              <div class="mb-3">
                <h5>{{ $question->question }}</h5>
                @if($question->type == 'choice')
                  @foreach($question->choices as $choice)
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="question_{{ $loop->parent->index }}" id="choice_{{ $loop->parent->index }}_{{ $loop->index }}">
                      <label class="form-check-label" for="choice_{{ $loop->parent->index }}_{{ $loop->index }}">
                        {{ $choice }}
                      </label>
                    </div>
                  @endforeach
                @elseif($question->type == 'blank')
                  <input type="text" class="form-control" name="question_{{ $loop->index }}">
                @endif
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
