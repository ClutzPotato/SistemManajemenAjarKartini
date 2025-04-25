<?php

namespace App\Http\Controllers;

use App\Models\FileAttachment;
use App\Models\Material;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quizzes = Quiz::all();
        return view('admin.quiz.index', compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Material $material)
    {
        return view('teacher.quizcreate', compact('material'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Material $material)
    {

            $request->validate([
                'title' => 'required|string|max:255',
                'questions' => 'required|array',
                'questions.*.question' => 'required|string',
                'questions.*.type' => 'required|in:choice,blank',
                'questions.*.choices' => 'nullable|array',
            ]);

            $quizData = $request->input('questions');
    
            $existingQuiz = Quiz::where('material_id', $material->id)
            ->first();
    
        if ($existingQuiz) {
            // Update the existing quiz and title
            $existingQuiz->title = $request->input('title');
            $existingQuiz->quiz_data = json_encode($quizData);
            $existingQuiz->save();
        } else {
            // Create a new quiz
            Quiz::create([
                'material_id' => $material->id,
                'title' => $request->input('title'),
                'quiz_data' => json_encode($quizData),
            ]);
        }
    
            return redirect()->route('teacher.materials.show', $material->id)->with('success', 'Quiz created successfully.');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Quiz $quiz)
    {
    
        $material = $quiz->material;
        return view('teacher.quizshow', compact('quiz', 'material'));
    }

    public function studentshow(Quiz $quiz)
    {
    
        $material = $quiz->material;
        return view('student.quizshow', compact('quiz', 'material'));
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
        $quiz = Quiz::findOrFail($id);
        $quiz->delete();

    return redirect()->back()->with('success', 'Quiz deleted successfully.');
    }
}
