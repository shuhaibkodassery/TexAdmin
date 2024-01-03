<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PagesController;
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
Route::get('/login', function () {
    return view('Admin.login');
});
Route::get('/logout', [UserController::class, 'deleteAllSession']);
Route::post('/login-user',[UserController::class,'loginUsers'])->name('login-user');
Route::get('/dashboard', [PagesController::class, 'loadDashboardPage']);