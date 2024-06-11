<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::orderBy('id', 'desc')->get();
        $total = Course::count();
        return view('admin.course.home', compact('courses', 'total'));
    }

    public function create()
    {
        return view('admin.course.create');
    }

    public function save(Request $request)
    {
        $validation = $request->validate([
            'title' => 'required',
            'credit' => 'required',
            'weekhours' => 'required',
        ]);

        $data = Course::create($validation);
        if ($data) {
            session()->flash('success', 'Course Added Successfully');
            return redirect(route('admin.courses.index'));
        } else {
            session()->flash('error', 'Some problem occurred');
            return redirect(route('admin.courses.create'));
        }
    }

    public function edit($id)
    {
        $course = Course::findOrFail($id);
        return view('admin.course.update', compact('course'));
    }

    public function delete($id)
    {
        $course = Course::findOrFail($id)->delete();
        if ($course) {
            session()->flash('success', 'Course Deleted Successfully');
            return redirect(route('admin.courses.index'));
        } else {
            session()->flash('error', 'Course Not Deleted Successfully');
            return redirect(route('admin.courses.index'));
        }
    }

    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        $title = $request->title;
        $credit = $request->credit;
        $weekhours = $request->weekhours;

        $course->title = $title;
        $course->credit = $credit;
        $course->weekhours = $weekhours;
        $data = $course->save();
        if ($data) {
            session()->flash('success', 'Course Updated Successfully');
            return redirect(route('admin.courses.index'));
        } else {
            session()->flash('error', 'Some problem occurred');
            return redirect(route('admin.courses.edit', $id));
        }
    }
}
