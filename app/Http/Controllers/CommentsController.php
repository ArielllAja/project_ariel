<?php

namespace App\Http\Controllers;

use App\Models\CommentModel;
use App\Models\FotoModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function show($id)
    {
        $photo = FotoModel::find($id);
        $commentsQuery = $photo->comments()->get();

        return view('dashboard.comment', compact('photo', 'commentsQuery'));
    }

    public function post(Request $request)
    {
        $request->validate([
            'comment' => 'required',
        ]);

        $comment = new CommentModel();
        $comment->foto_id = $request->input('foto_id');
        $comment->user_id = Auth::id();
        $comment->commenter_name = Auth::user()->name;
        $comment->comment = $request->input('comment');
        $comment->save();

        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan');
    }
}
