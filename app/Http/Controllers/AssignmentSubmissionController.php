<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AssignmentSubmission;
use App\Models\Material;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AssignmentSubmissionController extends Controller
{
    public function index()
    {
        $assignments = AssignmentSubmission::all();
        return view('admin.assignment.index', compact('assignments'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'material_id' => 'required|exists:materials,id',
            'file' => 'required|file|mimes:pdf,doc,docx,zip,jpg,jpeg,png,gif|max:2048',
        ]);

        $user = Auth::user();
        $material = Material::findOrFail($request->material_id);
        $materialName = preg_replace('/\s+/', '_', $material->title); // Replace spaces with underscores

        // Check if the material type is 'assignment'
        if ($material->type !== 'assignment') {
            return redirect()->back()->withErrors(['error' => 'This material is not an assignment']);
        }

        // Handle file upload
        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $filePath = 'assignments/' . $materialName . '/' . $user->id . '/' . $fileName;
        $file->storeAs('assignments/' . $materialName . '/' . $user->id, $fileName);

        AssignmentSubmission::where('student_id', $user->id)
        ->where('material_id', $material->id)
        ->delete();

        // Save the submission record
        AssignmentSubmission::create([
            'student_id' => $user->id,
            'material_id' => $material->id,
            'file_name' => $file->getClientOriginalName(),
            'file_path' => $filePath,
        ]);

        return redirect()->back()->with('success', 'Assignment submitted successfully.');
    }

    public function destroy($id)
    {
        $assignment = AssignmentSubmission::findOrFail($id);
        $assignment->delete();
    
        return redirect()->back()->with('success', 'Assignment deleted successfully.');
    }
}
