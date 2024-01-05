<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProductController;

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

Route::get('/', function () {
    if(Session('activeUser')){
        return redirect('/dashboard');
    }else {
        return redirect('/login');
    }
});
Route::get('/login', function () {
    return view('Admin.login');
});
Route::get('/logout', [UserController::class, 'deleteAllSession']);
Route::post('/login-user',[UserController::class,'loginUsers'])->name('login-user');
#Admin Routes
Route::group(['middleware' => 'user-auth'], function() {
    Route::get('/dashboard', [PagesController::class, 'loadDashboardPage']);
    Route::group(['prefix' => 'admin'], function(){
        Route::group(['prefix' => 'sales'], function() {
            Route::get('/', [PagesController::class, 'loadSalesPageForAdmin']);
            Route::post('/', [ProductController::class, 'createSale']);
        });
        Route::group(['prefix' => 'product'], function() {
            Route::get('/', [PagesController::class, 'loadProductPageForAdmin']);
            Route::post('/', [ProductController::class, 'createProduct']);
            Route::delete('/{id}', [ProductController::class, 'deleteProductByid']);
        });
        Route::get('/sales-report', [PagesController::class, 'SalesReportForAdmin']);
    });
});