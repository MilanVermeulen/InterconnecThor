<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FollowController extends Controller
{
    /**
     * Follow a user.
     *
     * @param Request $request
     * @param User $user
     * @return Response
     */
    public function follow(Request $request, User $user)
    {
        $request->user()->follow($user);

        return back()->with('success', 'Successfully followed user.');
    }

    /**
     * Unfollow a user.
     *
     * @param Request $request
     * @param User $user
     * @return Response
     */
    public function unfollow(Request $request, User $user)
    {
        $request->user()->unfollow($user);

        return back()->with('success', 'Successfully unfollowed user.');
    }

    public function following($id)
    {
        $user = User::find($id);
        $following = $user->following;
        return view('following', compact('following'));
    }

    public function followers($id)
    {
        $user = User::find($id);
        $followers = $user->followers;
        return view('followers', compact('followers'));
    }

    public function connections($id)
    {
        $user = User::find($id);

        if (!$user) {
            return back()->with('error', 'User not found');
        }

        $connections = $user->connections();
        return view('connections', compact('connections'));
    }

}
