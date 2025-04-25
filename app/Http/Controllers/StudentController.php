<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\ClassModel;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::all();
        $classes = ClassModel::all();

        $studentsbatch = Student::Paginate(25); 

        if (request()->ajax()) {
            return view('admin.student.partials.students', compact('studentsbatch'))->render();
        }
    
        return view('admin.student.index', compact('students','classes','studentsbatch'));
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
        //
    }
    public function storeBatch(Request $request)
    {
        $request->validate([
            'number_of_students' => 'required|integer|min:1',
            'password' => 'required|string|min:8',
        ]);
    
        $numberOfStudents = $request->input('number_of_students');
        $password = $request->input('password');
    
        for ($i = 1; $i <= $numberOfStudents; $i++) {

        $userId = DB::table('users')->max('id') + 1;

        $username = "Student" . $userId;
        $email = "Student" . $userId . "@smakartinibatam";

        // Check if a user with the same username or email already exists
        if (User::where('name', $username)->orWhere('email', $email)->exists()) {
                continue; // Skip the creation if a user already exists with this username or email
            }

            $user = new User();
            $user->name = $username;
            $user->email = $email;
            $user->password = Hash::make($password);
            $user->role = 'student';
            $user->save();
        }
    
        return redirect()->route('users.index')->with('success', 'Batch of students created successfully.');
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
    public function update(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'class_id' => 'nullable|exists:class,id',
        ]);

        $student = Student::find($request->input('student_id'));
        $student->class_id = $request->input('class_id');
        $student->save();

        return redirect()->back()->with('success', 'Class assigned successfully.');
    }

public function batchAssign(Request $request)
{
    $request->validate([
        'class_id' => 'required|exists:class,id',
        'users' => 'required|array',
    ]);

    $classId = $request->input('class_id');
    $userIds = $request->input('users');

    // Loop through each selected user and assign them to the class
    foreach ($userIds as $userId) {
        $student = Student::where('user_id', $userId)->first();
        if ($student) {
            $student->class_id = $classId;
            $student->save();
        }
    }

    return redirect()->back()->with('success', 'Users assigned to class successfully.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    $students = Student::findOrFail($id);
    $students->delete();

    return redirect()->route('students.index')->with('success', 'Subject deleted successfully.');
    }
}
