<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\ClassMajorModel;
use App\Models\SubjectModel;
use Illuminate\Http\Request;
use App\Models\Student;

class ClassController extends Controller
{
    public function index()
    {
        $classes = ClassModel::all();
        $classMajors = ClassMajorModel::all();
        $subjects = SubjectModel::all();
        $subjectsbatch = SubjectModel::Paginate(25);
        return view('admin.classes.index', compact('classes','classMajors','subjects','subjectsbatch'));
    }

    public function teacherindex()
    {
        $classes = ClassModel::all();
        $classMajors = ClassMajorModel::all();
        $students = Student::all();
        $studentsbatch = Student::Paginate(25); 
        $subjects = SubjectModel::all();
        $subjectsbatch = SubjectModel::Paginate(25);
        return view('teacher.classesindex', compact('classes','classMajors','students','studentsbatch','subjects','subjectsbatch'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_name' => 'required|string|max:255',
            'class_major' => 'required|string|exists:class_major,class_major_name',
            'class_capacity' => 'required|integer',
        ]);

        ClassModel::create($request->all());
        return redirect()->back()->with('success', 'Class created successfully.');
    }
    public function update(Request $request, $id)
{
    $request->validate([
        'class_name' => 'required|string|max:255',
        'class_major' => 'required|string|exists:class_major,class_major_name',
        'class_capacity' => 'required|integer',
    ]);

    $class = ClassModel::findOrFail($id);
    $class->update($request->all());

    return redirect()->back()->with('success', 'Class updated created successfully.');
}
    public function destroy($id)
{
    $class = ClassModel::findOrFail($id);
    $class->delete();

    return redirect()->back()->with('success', 'Class deleted successfully.');
}

    public function updateClassMajor(Request $request, $id)
    {
        $request->validate([
            'class_major_name' => 'required|string|max:255|unique:class_major,class_major_name,'.$id,
        ]);
        $class = ClassMajorModel::findOrFail($id);
        $class->update($request->all());
    
        return redirect()->back()->with('success', 'Class Major updated successfully.');
    }
    public function storeClassMajor(Request $request)
    {
        $request->validate([
            'class_major_name' => 'required|string|max:255|unique:class_major,class_major_name',
        ]);

        ClassMajorModel::create($request->all());

        return redirect()->back()->with('success', 'Class Major created successfully.');
    }
    public function destroyClassMajor($id)
{
    $class = ClassMajorModel::findOrFail($id);
    $class->delete();

    return redirect()->route('classes.index')->with('success', 'Class deleted successfully.');
}

public function attachSubjects(Request $request)
{
    $class = ClassModel::find($request->class_id);
    if ($class) {
        // Use sync to attach multiple subjects
        $class->subjects()->sync($request->subjects);

        return redirect()->back()->with('success', 'Subject attached successfully.');
    }
    
    return redirect()->back()->with('error', 'Class not found');
}

}
