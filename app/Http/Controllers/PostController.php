<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $post = new Post([
            'title' => $request->get('title'),
            'description' => $request->get('description')
        ]);

        $post->save();

        return response()->json([
            'message' => 'Successfully created post!'
        ], 201);
    }
}
