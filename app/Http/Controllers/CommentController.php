<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request){
        $valdated = $request->validate([
           'content' => 'required',
           'post_id' => 'required|numeric|exists:posts,id'
        ]);

        Auth::user()->comments()->create($valdated);
        return back()->with('message', 'comment saktaldy');
    }

    public function destroy(Comment $comment){
        $comment->delete();
        return back()->with('message', 'comment oshirildi');
    }
}
