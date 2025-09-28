<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Picture;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy("created_at", "desc")->get();
        return view('posts', compact('posts'));
    }
    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'body' => 'text|required',
        ]);
        if ($request->hasFile('picture')) {
            $path = $request->file('picture')->store('avatars', 'public');
            $data['avatar'] = $path;

            Picture::create([
                'path' => $data['avatar'],
                'picturable_id' => 1,
                'picturable_type' => 'App\Posts',
            ]);
        }
        Post::create([
            'title'=> $request->title,
            'body'=> $request->body,
        ]);
        return redirect()->route('posts')->with('success','post has been created');
    }
}
