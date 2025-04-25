@extends('layouts.teacherdefault')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Quiz Submission from {{$quizSubmission->student->name}} for {{$quizSubmission->quiz->title}}</div>

                <div class="card-body">
                    @php
                        $answers = json_decode($quizSubmission->answers, true);
                    @endphp

                    @if (!empty($answers))
                        @foreach ($answers as $index => $answer)
                            <p>Question {{ $index + 1 }} Answer: {{ $answer }}</p>
                        @endforeach
                    @else
                        <p>No answers submitted.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
