<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
    public function store(Request $request, Comment $comment, Post $post)
    {
        $input = $request['comment'];
        $comment->fill($input)->save();
        return redirect("/post/".$post->id);
    }
    
    public function destroy(Comment $comment, Post $post)
    {
        $comment->delete();
        return redirect("/post/" . $post->id);
    }
    
}
