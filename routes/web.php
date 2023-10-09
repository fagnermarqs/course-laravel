<?php

use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('admin.users');
});

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.'
    ], 
    function () {
        Route::get('dashboard', function () {
            return 'dashboard';
        })->name('dashboard');
        
        Route::get('users', function () {
            return 'users';
        })->name('users');
});

Route::group([
        'prefix' => 'product',
        'as' => 'product.'
    ],
    function () {
        Route::get('/', [SiteController::class, 'index'])->name('index');
        Route::get('/create', [ProdutoController::class, 'create'])->name('create');
        Route::post('/create', [ProdutoController::class, 'store'])->name('save');
        Route::get('/edit/{id}', [ProdutoController::class, 'edit'])->name('edit');
        Route::post('/edit/{id}', [ProdutoController::class, 'edit'])->name('edit');
        Route::get('/show/{slug}', [ProdutoController::class, 'show'])->name('show');
        Route::get('/list', [ProdutoController::class, 'index'])->name('list');
        Route::delete('/{id}', [ProdutoController::class, 'destroy'])->name('destroy');
        Route::get('/category/{category}', [ProdutoController::class, 'productsByCategory'])->name('category');
        Route::get('/cart', [CarrinhoController::class, 'cartList'])->name('cart');
        Route::post('/cart', [CarrinhoController::class, 'addCart'])->name('add-cart');
        Route::delete('/cart/delete/{id}', [CarrinhoController::class, 'delete'])->name('delete-cart');
        Route::delete('/cart/clear', [CarrinhoController::class, 'clear'])->name('clear-cart');
        Route::put('/cart/update/{id}', [CarrinhoController::class, 'update'])->name('update-cart');
});

Route::get('/', [SiteController::class, 'index']);
