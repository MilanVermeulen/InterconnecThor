<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;

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
Route::get('/register', [RegistrationController::class, 'create'])->name('register');
Route::post('/register', [RegistrationController::class, 'store']);