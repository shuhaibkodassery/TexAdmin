<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\{ExpenseController,PurchaseController};

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
        return redirect('/');
    }
});
Route::get('/', function () {
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
            Route::post('delete/{id}', [ProductController::class, 'deleteSale']);
        });
        Route::group(['prefix' => 'product'], function() {
            Route::get('/', [PagesController::class, 'loadProductPageForAdmin']);
            Route::post('/', [ProductController::class, 'createProduct']);
            Route::post('delete/{id}', [ProductController::class, 'deleteProductByid']);
        });
        Route::get('/sales-report', [PagesController::class, 'SalesReportForAdmin']);
        Route::group(['prefix' => 'expense'], function() {
            Route::get('/', [PagesController::class, 'loadExpensePage']);
            Route::post('/', [ExpenseController::class, 'createExpense']);
            Route::put('/{id}', [ExpenseController::class, 'updateExpense']);
            Route::post('delete/{id}', [ExpenseController::class, 'deleteExpense']);
        });
        Route::group(['prefix' => 'purchase'], function() {
            Route::post('/', [PurchaseController::class, 'createPurchase']);
            Route::get('/', [PagesController::class, 'getAllPurchase']);
            Route::post('delete/{id}', [PurchaseController::class, 'deletePurchase']);
        });
    });
});