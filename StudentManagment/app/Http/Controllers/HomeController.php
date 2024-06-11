<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index_admin(){
        return view('dashboard');
    }
    public function index_student(){
        return view('student.dashboard');
    }
}
