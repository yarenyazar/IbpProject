<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index()
    {
        $students = User::where('usertype', 'user')->orderBy('id', 'desc')->get();
        $total = $students->count();
        return view('student.home', compact('students', 'total'));
    }

    public function create()
    {
        return view('student.create');
    }

    public function save(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $data = User::create([
            'name' => $validation['name'],
            'email' => $validation['email'],
            'password' => Hash::make($validation['password']),
        ]);

        if ($data) {
            session()->flash('success', 'Student Added Successfully');
            return redirect(route('admin.students.index'));
        } else {
            session()->flash('error', 'Some problem occurred');
            return redirect(route('admin.students.create'));
        }
    }

    public function edit($id)
    {
        $student = User::findOrFail($id);
        return view('student.update', compact('student'));
    }

    public function delete($id)
    {
        $student = User::findOrFail($id)->delete();
        if ($student) {
            session()->flash('success', 'Student Deleted Successfully');
            return redirect(route('admin.students.index'));
        } else {
            session()->flash('error', 'Student Not Deleted Successfully');
            return redirect(route('admin.students.index'));
        }
    }

    public function update(Request $request, $id)
    {
        $student = User::findOrFail($id);
        $student->name = $request->name;
        $student->email = $request->email;
        if ($request->password) {
            $student->password = Hash::make($request->password);
        }
        $data = $student->save();
        if ($data) {
            session()->flash('success', 'Student Updated Successfully');
            return redirect(route('admin.students.index'));
        } else {
            session()->flash('error', 'Some problem occurred');
            return redirect(route('admin.students.edit', $id));
        }
    }
}

