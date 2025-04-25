@extends('layouts.teacherdefault')


@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h1 class="text-light">Create Quiz for {{ $material->title }}</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div>
    </div>

    <div class="content">
  <div class="container-fluid">
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
    
    <div class="row">
        <div class="col-md-12">
            <div class="card elevation-3">

                <form method="POST" action="{{ route('quiz.store', $material->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Quiz Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>

                    <div id="questions">
                        <div class="form-group" id="question_1">
                            <label for="question_1">Question 1</label>
                            <input type="text" class="form-control" id="question_1" name="questions[0][question]" >
                            
                            <label for="type_1">Question Type</label>
                            <select class="form-control" id="type_1" name="questions[0][type]" onchange="toggleChoices(this, 0)">
                                <option value="choice">Multiple Choice</option>
                                <option value="blank">Fill in the Blank</option>
                            </select>
                            
                            <div id="choices_0" class="choices">
                                <label for="choices_0_1">Choice 1</label>
                                <input type="text" class="form-control" id="choices_0_1" name="questions[0][choices][]" >
                                
                                <label for="choices_0_2">Choice 2</label>
                                <input type="text" class="form-control" id="choices_0_2" name="questions[0][choices][]" >
                                
                                <button type="button" class="btn btn-secondary" onclick="addChoice(0)">Add Another Choice</button>
                                
                            
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-warning" onclick="addQuestion()">Add Another Question</button>
                    <br><br>


                    
                    <button type="submit" class="btn btn-success">Create Quiz</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection



<script>
let questionCount = 1;
let choiceCounts = [2]; // Track number of choices for each question
function addQuestion() {
    questionCount++;
    choiceCounts.push(2); // Initialize choice count for new question

    let questionHtml = `
        <div class="form-group" id="question_${questionCount}">
            <label for="question_${questionCount}">Question ${questionCount}</label>
            <input type="text" class="form-control" id="question_${questionCount}" name="questions[${questionCount - 1}][question]" required>
            
            <label for="type_${questionCount}">Question Type</label>
            <select class="form-control" id="type_${questionCount}" name="questions[${questionCount - 1}][type]" onchange="toggleChoices(this, ${questionCount - 1})">
                <option value="choice">Multiple Choice</option>
                <option value="blank">Fill in the Blank</option>
            </select>
            
            <div id="choices_${questionCount - 1}" class="choices">
                <label for="choices_${questionCount - 1}_1">Choice 1</label>
                <input type="text" class="form-control" id="choices_${questionCount - 1}_1" name="questions[${questionCount - 1}][choices][]" >
                
                <label for="choices_${questionCount - 1}_2">Choice 2</label>
                <input type="text" class="form-control" id="choices_${questionCount - 1}_2" name="questions[${questionCount - 1}][choices][]" >
                
                <button type="button" class="btn btn-secondary" onclick="addChoice(${questionCount - 1})">Add Another Choice</button>
            </div>
            
            <button type="button" class="btn btn-danger" onclick="removeQuestion(${questionCount - 1})">Remove Question</button>
        </div>
    `;

    document.getElementById('questions').insertAdjacentHTML('beforeend', questionHtml);
}


function addChoice(questionIndex) {
    choiceCounts[questionIndex]++;
    let choiceIndex = choiceCounts[questionIndex];

    let choiceHtml = `
    <div id="div_${questionIndex}_${choiceIndex}">    
    <br>
        <label for="choices_${questionIndex}_${choiceIndex}">Choice ${choiceIndex}</label>
        <input type="text" class="form-control" id="choices_${questionIndex}_${choiceIndex}" name="questions[${questionIndex}][choices][]" >
        <button type="button" class="btn btn-danger" onclick="removeChoice(${questionIndex}, ${choiceIndex})">Remove Choice</button>
    </div>
    `;

    document.getElementById(`choices_${questionIndex}`).insertAdjacentHTML('beforeend', choiceHtml);
}

function removeQuestion(questionIndex) {
    let questionDiv = document.getElementById(`question_${questionCount}`);
    questionCount--;
    questionDiv.remove();
    choiceCounts.splice(questionIndex, 1);
}

function removeChoice(questionIndex, choiceIndex) {
    let choiceDiv = document.getElementById(`div_${questionIndex}_${choiceIndex}`);
    choiceCounts[questionIndex]--;
    choiceDiv.remove();
}
function toggleChoices(selectElement, questionIndex) {
    let choiceDiv = document.getElementById(`choices_${questionIndex}`);
    if (selectElement.value === 'choice') {
        choiceDiv.style.display = 'block';
        // Add required attribute to choice inputs
        //Array.from(choiceDiv.querySelectorAll('input')).forEach(input => {
       //     input.setAttribute('required', 'required');
       // });
    } else {
        choiceDiv.style.display = 'none';
        // Remove required attribute from choice inputs
        Array.from(choiceDiv.querySelectorAll('input')).forEach(input => {
            input.removeAttribute('required');
        });
        // Remove the 'required' attribute from all inputs under this question group
        let inputs = document.querySelectorAll(`#question_${questionIndex + 1} input`);
        inputs.forEach(input => {
            input.removeAttribute('required');
        });
    }
}


// Add event listener to log form data and prevent form submission if necessary
document.querySelector('form').addEventListener('submit', function (event) {
    let formData = new FormData(this);
    console.log('Form Data:', formData);
    
    // Add more comprehensive validation checks here if needed
    // For example, check if all the required fields are filled out

    // Uncomment the following line to prevent form submission for debugging purposes
    // event.preventDefault();
});

</script>
