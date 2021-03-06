<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\Checkoutcontroller;

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

Auth::routes();

Route::get('/',[FrontendController::class,'index']);
Route::get('/category',[FrontendController::class,'category']);
Route::get('view-category/{slug}',[FrontendController::class,'viewcategory']);
Route::get('category/{category_slug}/{product_slug}',[FrontendController::class,'productview']);

Route::post('/add-to-cart' , [CartController::class,'addproduct']);
Route::post('/delete-cart-item' , [CartController::class,'deleteproduct']);
Route::post('/update-cart' , [CartController::class,'updatecart']);

Route::middleware(['auth'])->group(function(){
    Route::get('/cart' , [CartController::class,'viewcart']);
    Route::get('/checkout' , [Checkoutcontroller::class,'index']);
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware(['auth','isadmin'])->group(function(){
    Route::get('/dashboard' , 'Admin\FrontendController@index');

    Route::get('categories' , 'Admin\CategoryController@index');
    Route::get('add-category' , 'Admin\CategoryController@add');
    Route::post('insert-category' , 'Admin\CategoryController@insert');
    Route::get('edit-category/{id}',[CategoryController::class,'edit']);
    Route::put('update-category/{id}',[CategoryController::class,'update']);
    Route::get('delete-category/{id}',[CategoryController::class,'destroy']);
    // products routes
    Route::get('products',[ProductController::class,'index']);
    Route::get('add-product' , [ProductController::class,'add']);
    Route::post('insert-product' , [ProductController::class,'insert']);
    Route::get('edit-prod/{id}',[ProductController::class,'edit']);
    Route::put('update-product/{id}',[ProductController::class,'update']);
    Route::get('delete-product/{id}',[ProductController::class,'destroy']);
});
