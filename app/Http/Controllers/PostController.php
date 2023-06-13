<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    //save post to database
    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $post = new Post([
            'title' => $request->input('title'),
            'description' => $request->input('description')
        ]);

        $post->user_id = Auth::id();

        $post->save();


        return redirect(route('home'))->with('success', 'Successfully created post!');
    }


    //show all posts
    public function home()
    {
        // Retrieve all posts from the database sort decent by id
        $posts = Post::with('users')->orderBy('id', 'desc')->get();
        // Pass the posts data to the home view
        return view('home', compact('posts'));
    }
}

