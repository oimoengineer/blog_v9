<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    public function welcome()
    {
        return view('welcome');
    }
    
    public function index(Post $post)
    {
        return view('index')->with(['posts' => $post->get()]);
    }
    
    public function show(Post $post)
    {
        return view('show')->with(['post' => $post]);
    }
    
    public function create()
    {
        return view('create');
    }
    
    public function store(Post $post, Request $request)
    {
        $input = $request['post'];
        $post->fill($input)->save();
        return redirect('/posts');
    }
    
    //いいね機能
    public function like(Request $request, Post $post)
    {
        $post->likes()->attach($request->user()->id);
        return redirect('/post/' . $post->id);
    }

    public function unlike(Request $request, Post $post)
    {
        $post->likes()->detach($request->user()->id);
        return redirect('/post/' . $post->id);
    }
}
