<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

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
// Route::get('/', function () {
//     return view('home');
// })->name('home');

Route::get('/', function () {
    return view('welcome');
});

// voyager
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

// // register students
// Route::get('/register', [StudentController::class, 'showRegisterForm'])->name('register');
// Route::post('/register', [StudentController::class, 'register']);

// // restrict logged in students with middleware
// Route::group(['middleware' => 'guest:student'], function () {
//     // login students
//     Route::get('/login', [StudentController::class, 'showLoginForm'])->name('login');
//     Route::post('/login', [StudentController::class, 'login']);
// });

// // logout students
// Route::post('/logout', [StudentController::class, 'logout'])->name('logout');

// // search students
// Route::get('/search', [StudentController::class, 'search'])->name('search');

// // basic routes
// Route::get('/about', function () {
//     return view('about');
// })->name('about');

// Route::get('/faq', function () {
//     return view('faq');
// })->name('faq');

// Route::get('/contact', function () {
//     return view('contact');
// })->name('contact');

// profile routes (only for logged in students)
// profile routes here