<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;

class AnnouncementController extends Controller
{
    public function index()
    {
        $messages = Announcement::orderBy('id', 'desc')->get();
        $total = $messages->count();
        return view('admin.announcement', compact('messages', 'total'));
    }

    public function create()
    {
        return view('admin.announcementCreate');
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $messages = new Announcement();
        $messages->title = $validation['title'];
        $messages->content = $validation['content'];
        $messages->save();

        if ($messages) {
            session()->flash('success', 'Announcement Added Successfully');
            return redirect(route('admin.messages.index'));
        } else {
            session()->flash('error', 'Some problem occurred');
            return redirect(route('admin.messages.create'));
        }
    }
}
