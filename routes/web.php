<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\PostController;

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

// meeting routes
Route::get('/meet', function () {
    return view('meet');
})->name('meet');

// post routes
Route::post("/createMeeting", [MeetingController::class, 'createMeeting'])->name("createMeeting");

Route::post("/validateMeeting", [MeetingController::class, 'validateMeeting'])->name("validateMeeting");

Route::get("/meeting/{meetingId}", function($meetingId) {

    $METERED_DOMAIN = env('METERED_DOMAIN');
    return view('meeting', [
        'METERED_DOMAIN' => $METERED_DOMAIN,
        'MEETING_ID' => $meetingId
    ]);
});

// middleware to check if user is logged in
Route::group(['middleware' => 'auth'], function () {
    // profile routes
    Route::get('userProfile', [UserController::class, 'showUserProfile'])->name('userProfile');

    Route::post('/postform',[PostController::class, 'create'])->name('postform');
    // search posts
    Route::post('/search-posts',[PostController::class, 'search'])->name('search-posts');
    // settings & privacy (show settings blade without controller)
    Route::get('/settings', function () {
        return view('settings');
    })->name('settings');
});

//search profile
Route::get('/searchProfile/{id}', [UserController::class, 'searchProfile'])->name('searchProfile');
