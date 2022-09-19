<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Tag;
use App\Models\Comment;

class PostController extends Controller
{
    public function welcome()
    {
        return view('welcome');
    }
    
    public function index(Post $post)
    {
        return view('index')->with(['posts' => $post->getPaginateByLimit()]);
    }
    
    public function show(Post $post, Comment $comment)
    {
        return view('show')->with(['post' => $post, 'comments' => $comment->where('post_id', '=', $post->id)->get()]);
    }
    
    public function create()
    {
        return view('create');
    }
    
    public function store(Post $post, Request $request)
    {
        
        $input_post = $request['post'];
        $post->fill($input_post)->save();
     
        preg_match_all('/#([a-zA-Z0-9０-９ぁ-んァ-ヶー一-龠]+)/u', $request->tag_name, $match);
        
        foreach($match[1] as $input)
        {
            $tag=Tag::firstOrCreate(['name'=>$input]);
            $tag=null;
            $tag_id=Tag::where('name',$input)->get(['id']);
            $post->tags()->attach($tag_id);
        }
        
        return redirect('/posts');
    }
    
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect("/posts");
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
