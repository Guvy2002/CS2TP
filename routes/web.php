<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BasketController;

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
    return redirect('home');
});

Route::get('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'register']);
Route::post('/register-user', [AuthController::class, 'registerUser'])->name('register-user');
Route::post('/login-user', [AuthController::class, 'loginUser'])->name('login-user');


Route::get('/home', [AuthController::class, 'home'])->middleware('isLoggedIn');
Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/manage', [ProductController::class, 'manage'])->middleware('isLoggedIn'); // middlware should be isAdmin
Route::post('/add-product', [ProductController::class, 'addProduct'])->name('add-product'); // middlware should be isAdmin

Route::get('/products', [ProductController::class, 'viewAllProducts']);

Route::get('/basket', [BasketController::class, 'viewBasket'])->name('basket')->middleware('isLoggedIn');
Route::post('/add-to-basket', [BasketController::class, 'addToBasket'])->name('add-to-basket'); //->middleware('is');
Route::get('/remove-from-basket/{id}', [BasketController::class, 'removeFromBasket'])->name('remove-from-basket'); //->middleware('is');
Route::get('/update-basket-quantity/{operation}/{id}', [BasketController::class, 'updateQuantity'])->name('updateQuantity');//->middleware('is');
