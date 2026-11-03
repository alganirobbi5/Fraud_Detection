<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\ScoringController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ErrorController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
	return view('login.login');
})->name('login');

Route::get('/login', function () {
	return view('login.login');
});

Route::get('/register', function () {
	return view('register.register');
});

Route::post('/register', [RegisterController::class, 'registration']);
Route::post('/login',[LoginController::class,'processLogin']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

Route::get('/data', [DataController::class, 'index'])->middleware('auth');
Route::post('/data/import_data', [DataController::class, 'import_data'])->middleware('auth');
Route::delete('/data/delete_data', [DataController::class, 'delete_data'])->middleware('auth');

Route::get('/scoring', [ScoringController::class, 'index'])->middleware('auth');
Route::get('/scoring', [ScoringController::class, 'scoring'])->middleware('auth');
Route::get('/404', [ErrorController::class, 'show'])->middleware('auth');

Route::get('/user', [UserController::class, 'user'])->middleware('auth');

Route::get('/user_add', [UserController::class, 'user_add'])->middleware('auth');
Route::post('/user_aksi', [UserController::class, 'user_aksi'])->middleware('auth');

Route::get('/user_edit/{id}', [UserController::class, 'user_edit'])->middleware('auth');
Route::put('/user_update/{id}', [UserController::class, 'user_update'])->middleware('auth');

Route::delete('/user_delete/{id}', [UserController::class, 'user_delete'])->middleware('auth');

Route::get('/password', [UserController::class, 'password'])->middleware('auth');
Route::post('/password_update', [UserController::class, 'password_update'])->middleware('auth');



