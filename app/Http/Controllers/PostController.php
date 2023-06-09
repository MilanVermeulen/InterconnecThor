<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


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

        // Check if the previous URL is the user profile page
        $userProfile = route('userProfile');
        if (url()->previous() == $userProfile) {
            return redirect($userProfile)->with('success', 'Successfully created post!');
        }

        // Redirect to the homepage
        return redirect(route('home'))->with('success', 'Successfully created post!');
    }

    //show all posts
    public function home()
    {
        // Retrieve all posts from the database sorted in descending order by id
        $posts = Post::with('user')
            ->orderBy('id', 'desc')
            ->paginate(5); // posts per page

        // Truncate the content of each post to a maximum of 255 characters
        foreach ($posts as $post) {
            $post->description = Str::limit($post->description, 255);
        }

        // Pass the modified posts data to the home view
        return view('home', compact('posts'));
    }

    // show followed users posts
    public function getFollowedUsersPosts()
    {
        $user = Auth::user();

        // Get the user ids of the users that the logged-in user is following
        $followingUserIds = $user->following->pluck('id')->toArray();

        // Add the logged-in user's id to the array
        $followingUserIds[] = $user->id;

        // Retrieve the followed users' posts and the logged-in user's posts with pagination
        $posts = Post::whereIn('user_id', $followingUserIds)
            ->orderBy('created_at', 'desc')
            ->paginate(5); // Adjust the number of posts per page as desired

        // Truncate the content of each post to a maximum of 255 characters
        foreach ($posts as $post) {
            $post->description = Str::limit($post->description, 255);
        }

        // Return a view with the paginated posts
        return view('home', compact('posts'));
    }

    // search for posts
    public function search(Request $request)
    {
        // Get the search value from the request
        $search = $request->input('search');

        // Search in the title and description columns from the posts table
        // Search in the name, first_name and last_name columns from the users table
        $posts = Post::query()
            ->where('title', 'LIKE', "%{$search}%")
            ->orWhere('description', 'LIKE', "%{$search}%")
            ->orWhereHas('user', function ($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('first_name', 'LIKE', "%{$search}%")
                    ->orWhere('last_name', 'LIKE', "%{$search}%");
            })
            ->paginate(5);

        // Truncate the content of each post to a maximum of 255 characters
        foreach ($posts as $post) {
            $post->description = Str::limit($post->description, 255);
        }

        // Return the home view with the results compacted
        return view('home', compact('posts'));
    }

    // show post view
    public function show($id)
    {
        $post = Post::findOrFail($id);
        $comments = Comment::where('post_id', $id)->get();

        return view('postShow', compact('post', 'comments'));
    }

    // create comment
    public function createComment(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|string|max:255',
        ]);

        $post = Post::findOrFail($id);

        $comment = new Comment();
        $comment->comment = $request->input('comment');
        $comment->user_id = Auth::id();

        $post->comments()->save($comment);

        return redirect()->back()->with('success', 'Comment added successfully!');
    }

    // delete comment
    public function deleteComment($id)
    {
        $comment = Comment::findOrFail($id);

        // Check if the authenticated user is authorized to delete the comment
        if ($comment->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'You are not authorized to delete this comment.');
        }

        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully!');
    }

    // delete post
    public function deletePost($id)
    {
        $post = Post::findOrFail($id);

        // Check if the authenticated user is authorized to delete the post
        if ($post->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'You are not authorized to delete this post.');
        }

        $post->delete();

        return redirect()->back()->with('success', 'Post deleted successfully!');
    }

    // like post
    public function likePost($id)
    {
        $post = Post::findOrFail($id);
        $post->likes()->attach(Auth::id());
        return redirect()->back()->with('success', 'Post liked successfully!');
    }

    // unlike post
    public function unlikePost($id)
    {
        $post = Post::findOrFail($id);
        $post->likes()->detach(Auth::id());
        return redirect()->back()->with('success', 'Post unliked successfully!');
    }

    // like comment
    public function likeComment($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->likes()->attach(Auth::id());
        return redirect()->back()->with('success', 'Comment liked successfully!');
    }

    // unlike comment
    public function unlikeComment($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->likes()->detach(Auth::id());
        return redirect()->back()->with('success', 'Comment unliked successfully!');
    }

    // show liked posts for logged in user
    public function showLikedPosts()
    {
        $user = Auth::user();

        $likedPosts = $user->likedPosts()
            ->orderBy('created_at', 'desc')
            ->paginate(5); // adjust this number to change the number of posts shown per page

        // Truncate the content of each post to a maximum of 255 characters
        foreach ($likedPosts as $post) {
            $post->description = Str::limit($post->description, 255);
        }

        return view('likedPosts', compact('likedPosts', 'user'));
    }

}
