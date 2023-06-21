<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FollowController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// home page
Route::get('/', [PostController::class, 'home'])->name('home');

// voyager
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

// register students
Route::get('/register', [UserController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [UserController::class, 'register']);

// restrict logged in users with middleware
Route::group(['middleware' => 'guest'], function () {
    // login users
    Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [UserController::class, 'login']);
    // forgot password
    Route::get('/forgot-password', [UserController::class, 'showForgotPasswordForm'])->name('forgot-password');
    // Forgot password email
    Route::post('/forgot-password', [EmailController::class, 'forgotPasswordEmail'])->name('forgot-password-email');
    // Reset password form
    Route::get('/reset-password/{token}', [UserController::class, 'showResetPasswordForm'])->name('reset-password');
    // Reset password
    Route::post('/password/update', [UserController::class, 'updatePassword'])->name('password.update');
});

// logout students
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

// search students
Route::get('/search', [UserController::class, 'search'])->name('search');

// basic routes
Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/faq', function () {
    return view('faq');
})->name('faq');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// send contact mail
Route::post('/contactemail', [EmailController::class, 'contactEmail'])->name('contactemail');

// middleware to check if user is logged in
Route::group(['middleware' => 'auth'], function () {
    // user profile
    Route::get('userProfile', [UserController::class, 'showUserProfile'])->name('userProfile');
    // non-user profile
    Route::get('/profile/{id}', [UserController::class, 'viewProfile'])->name('viewProfile');
    // post form
    Route::post('/postform',[PostController::class, 'create'])->name('postform');
    // Show edit profile view
    Route::get('/edit-profile', [UserController::class, 'showUpdateProfile'])->name('user.showUpdateProfile');
    // Update profile
    Route::post('/update-profile', [UserController::class, 'updateProfile'])->name('user.updateProfile');
    // delete user
    Route::delete('/user/{user}', [UserController::class, 'deleteUser'])->name('user.deleteUser');
    // search posts
    Route::post('/search-posts',[PostController::class, 'search'])->name('search-posts');
    // show post
    Route::get('/post/{id}', [PostController::class, 'show'])->name('post.show');
    // create comment
    Route::post('/posts/{id}/comments', [PostController::class, 'createComment'])->name('posts.comments.create');
    // delete comment
    Route::delete('/comments/{id}', [PostController::class, 'deleteComment'])->name('comments.delete');
    // delete post
    Route::delete('/post/{id}', [App\Http\Controllers\PostController::class, 'deletePost'])->name('post.delete');
    // follow
    Route::post('follow/{user}', [FollowController::class, 'follow'])->name('follow');
    // unfollow
    Route::delete('unfollow/{user}', [FollowController::class, 'unfollow'])->name('unfollow');
    // following list
    Route::get('user/{id}/following', [FollowController::class, 'following'])->name('user.following');
    // followers list
    Route::get('user/{id}/followers', [FollowController::class, 'followers'])->name('user.followers');
    // connections list
    Route::get('user/{id}/connections', [FollowController::class, 'connections'])->name('user.connections');
    // followed posts
    Route::get('/followedPosts', [App\Http\Controllers\PostController::class, 'getFollowedUsersPosts'])->name('followedPosts');
    // meeting routes
    Route::get('/meet', function () {
        return view('meet');
    })->name('meet');
    // create meeting
    Route::post("/createMeeting", [MeetingController::class, 'createMeeting'])->name("createMeeting");
    // validate meeting
    Route::post("/validateMeeting", [MeetingController::class, 'validateMeeting'])->name("validateMeeting");
    // join meeting
    Route::get("/meeting/{meetingId}", function ($meetingId) {
        // get metered domain from .env file
        $METERED_DOMAIN = env('METERED_DOMAIN');
        return view('meeting', [
            'METERED_DOMAIN' => $METERED_DOMAIN,
            'MEETING_ID' => $meetingId
        ]);
    });
});




