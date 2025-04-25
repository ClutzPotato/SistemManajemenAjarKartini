<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\SubjectModel;
use App\Models\FileAttachment;
use App\Models\AssignmentSubmission;
use App\Models\Quiz;
use App\Models\QuizSubmission;
use Illuminate\Support\Facades\Auth;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $materials = Material::all();
        $subjects = SubjectModel::all();
        return view('admin.material.index', compact('materials','subjects'));
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
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'subject_id' => 'required|exists:subject,id',
        ]);

        Material::create($request->all());

        return redirect()->back()->with('success', 'Material Created successfully.');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'subject_id' => 'required|exists:subject,id',
        ]);
    
        $material = Material::findOrFail($id);
        $material->update($request->all());
        
        return redirect()->back()->with('success', 'Material Updated successfully.');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $material = Material::findOrFail($id);
        $material->delete();
    
        return redirect()->back()->with('success', 'Material Deleted successfully.');
    }

    //teacher

    public function teacherindex(string $id)
    {
        $subject = SubjectModel::findOrFail($id);
        $subjects = SubjectModel::all();
        $materials = Material::where('subject_id', $id)->get();
        return view('teacher.materialsindex', compact('subject','subjects', 'materials'));
    }

    public function teachershow(Material $material)
    {
    $materialid = $material->id;
    $quiz = Quiz::where('material_id', $material->id)->first();

    if ($quiz !== null){
        $quizsubmissions = QuizSubmission::where('quiz_id', $quiz->id)->get();
    }
    else{
        $quizsubmissions = null;
    }

    $assignments = AssignmentSubmission::where('material_id', $materialid)->get();
    $attachments = FileAttachment::where('material_id', $materialid)->get();
        return view('teacher.material', compact('material','attachments','assignments','quiz','quizsubmissions'));
    }

//student
public function studentindex(string $id)
{
    $subject = SubjectModel::findOrFail($id);
    $materials = Material::where('subject_id', $id)->get();
    return view('student.materialsindex', compact('subject', 'materials'));
}

public function studentshow(Material $material)
{
    $materialid = $material->id;
    $user = Auth::user();
    $quiz = Quiz::where('material_id', $material->id)->first();

    if ($quiz !== null){
    $quizsubmission = QuizSubmission::where('quiz_id', $quiz->id)
    ->where('student_id', $user->id)
    ->first();
    }
    else{
        $quizsubmission = null;
    }


    $assignment = AssignmentSubmission::where('material_id', $material->id)
    ->where('student_id', $user->id)
    ->first();
    $attachments = FileAttachment::where('material_id', $materialid)->get();
    return view('student.material', compact('material','attachments','assignment','quiz','quizsubmission'));

}


}

