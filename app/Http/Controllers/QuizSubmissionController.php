<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\QuizSubmission;
use Illuminate\Support\Facades\Auth;

class QuizSubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quizzes = QuizSubmission::all();
        return view('admin.quizsubmission.index', compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Quiz $quiz)
    {
        $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'required',
        ]);
    
        $material = $quiz->material;
        $studentId = Auth::id();
        $quizId = $quiz->id;
    
        // Check if a quiz submission already exists for the given quiz ID and student ID
        $existingSubmission = QuizSubmission::where('quiz_id', $quizId)
            ->where('student_id', $studentId)
            ->first();
    
        if ($existingSubmission) {
            // Update the existing submission with the new answers
            $existingSubmission->answers = json_encode($request->answers);
            $existingSubmission->save();
        } else {
            // Create a new quiz submission
            QuizSubmission::create([
                'quiz_id' => $quizId,
                'student_id' => $studentId,
                'answers' => json_encode($request->answers),
            ]);
        }
    
        return redirect()->route('student.materials.show', $material->id)->with('success', 'Quiz submitted successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(QuizSubmission $quizSubmission)
    {
        return view('student.quizshowresult', compact('quizSubmission'));
    }
    public function teachershow(QuizSubmission $quizSubmission)
    {
        return view('teacher.quizshowresult', compact('quizSubmission'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $quiz = QuizSubmission::findOrFail($id);
        $quiz->delete();

    return redirect()->back()->with('success', 'Quiz deleted successfully.');
    }
}
