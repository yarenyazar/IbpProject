<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserMessage;

class UserMessageController extends Controller
{
    public function index()
    {
        $messages = UserMessage::orderBy('id', 'desc')->get();
        $total = $messages->count();
        return view('student.message', compact('messages', 'total'));
    }

    public function create()
    {
        return view('student.messageCreate');
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $message = new UserMessage();
        $message->title = $validation['title'];
        $message->content = $validation['content'];
        $message->save();

        if ($message) {
            session()->flash('success', 'Message Added Successfully');
            return redirect(route('user_messages.index'));
        } else {
            session()->flash('error', 'Some problem occurred');
            return redirect(route('user_messages.create'));
        }
    }
}
