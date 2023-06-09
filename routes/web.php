<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MeetingController;

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
Route::get('/', function () {
    return view('home');
})->name('home');

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

// profile routes (only for logged in students)
// profile routes here

// meeting routes
Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');


Route::post("/createMeeting", [MeetingController::class, 'createMeeting'])->name("createMeeting");

Route::post("/validateMeeting", [MeetingController::class, 'validateMeeting'])->name("validateMeeting");

Route::get("/meeting/{meetingId}", function($meetingId) {

    $METERED_DOMAIN = env('METERED_DOMAIN');
    return view('meeting', [
        'METERED_DOMAIN' => $METERED_DOMAIN,
        'MEETING_ID' => $meetingId
    ]);
});