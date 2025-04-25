<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;
use App\Models\User;
use App\Models\Material;
use App\Models\SubjectModel;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function admindashboard()
    {
        $classes = ClassModel::all();
        $users = User::all();
        $materials = Material::all();
        $subjects = SubjectModel::all();
        return view('admin.dashboard',  compact('classes','users','materials','subjects'));
    }

}
