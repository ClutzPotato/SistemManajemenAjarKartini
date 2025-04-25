<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubjectModel;
use Illuminate\Support\Facades\Auth;
class SubjectController extends Controller
{
    //
    public function index(Request $request)
    {
        // Get search query if exists
        $search = $request->input('search');

    // Fetch subjects with pagination, sorting, and search
    if ($search) {
     $subjects = SubjectModel::where('subject_name', 'LIKE', '%' . strtolower($search) . '%')->get();
    }
    else
    {
        $subjects = SubjectModel::all();
    }
        return view('admin.subject.index', compact('subjects'));
    }

    
    public function subjectsindex(Request $request)
    {
        $query = $request->input('query');

        if ($query) {
            // Search subjects by name, case-insensitive
            $subjects = SubjectModel::where('subject_name', 'LIKE', '%' . strtolower($query) . '%')
            ->paginate(9); 
        } else {
            $subjects = SubjectModel::paginate(9);
        }

        return view('teacher.subjects', compact('subjects'));
    }

    public function studentsubjectsindex(Request $request)
    {
        $query = $request->input('query');

        // Get the currently authenticated user
        $user = Auth::user();

        // Get the student's class ID
        $classId = $user->student->class_id;

        if ($query) {
            // Search subjects by name, case-insensitive, and filter by class ID
            $subjects = SubjectModel::where('subject_name', 'LIKE', '%' . strtolower($query) . '%')
                ->whereHas('classes', function ($q) use ($classId) {
                    $q->where('class_id', $classId);
                })
                ->get();
        } else {
            // Get all subjects for the user's class
            $subjects = SubjectModel::whereHas('classes', function ($q) use ($classId) {
                $q->where('class_id', $classId);
            })
            ->get();
        }

        return view('student.subjects', compact('subjects'));
    
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'subject_name' => 'required|string|max:255|unique:subject,subject_name,'.$id,
            'subject_description' => 'required|string',
        ]);
        
        $subject = SubjectModel::findOrFail($id);
        $subject->update($request->all());
    
        return redirect()->route('subjects.index')->with('success', 'Subject updated successfully.');
    }
    
    
    public function store(Request $request)
    {
        $request->validate([
            'subject_name' => 'required|string|max:255|unique:subject,subject_name',
            'subject_description' => 'required|string',
        ]);

        SubjectModel::create($request->all());

        return redirect()->route('subjects.index')->with('success', 'Subject created successfully.');
    }
    public function destroy($id)
{
    $subjects = SubjectModel::findOrFail($id);
    $subjects->delete();

    return redirect()->route('subjects.index')->with('success', 'Subject deleted successfully.');
}
}
