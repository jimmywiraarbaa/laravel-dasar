<?php

use App\Http\Controllers\FileController;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\InputController;
use App\Http\Controllers\ResponseController;
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
    return view('welcome');
});

Route::get('/jwa', function () {
    return "Jimmy Wira Arbaa";
});

Route::redirect('/jimmy', '/jwa');

Route::get('/hello', function () {
    return view('hello', ['name' => 'Jimmy']);
});

Route::get('/author', function () {
    return view('author.jimmy', ['name' => 'Jimmy Wira Arbaa']);
});

Route::get('/products/{id}', function ($productId) {
    return "Product ID : $productId";
})->name('product.detail');

Route::get('/products/{product}/items/{item}', function ($productId, $itemId) {
    return "Product ID : $productId, Item : $itemId";
})->name('product.item.detail');

Route::get('/category/{id}', function ($categoryId) {
    return "Category ID : $categoryId";
})->where('id', '[0-9]+')->name('category.detail');

Route::get('/Users/{id?}', function ($userId = '404') {
    return "User ID : $userId";
})->name('user.detail');

Route::get('/players/{$name}', function (string $name) {
    return "Player $name";
})->name('player.detail');

Route::get('/players/jimmy', function () {
    return "Player jimmy wira arbaa";
})->name('player.detail');

Route::get('/produk/{id}', function ($id) {
    $link = route('product.detail', ['id' => $id]);
    return "$link";
});

Route::get('/products-redirect/{id}', function ($id) {
    return redirect()->route('product.detail', ['id' => $id]);
});


// HelloController
Route::get('/greeting/hello/request', [HelloController::class, 'request']);
Route::get('/greeting/hello/{name}', [HelloController::class, 'hello']);

// InputController
Route::get('/input/hello', [InputController::class, 'hello']);
Route::post('/input/hello', [InputController::class, 'hello']);
Route::post('/input/hello/first', [InputController::class, 'helloFirstName']);
Route::post('/input/hello/input', [InputController::class, 'helloInput']);
Route::post('/input/hello/array', [InputController::class, 'arrayInput']);
Route::post('/input/type', [InputController::class, 'inputType']);
Route::post('/input/filter/only', [InputController::class, 'filterOnly']);
Route::post('/input/filter/except', [InputController::class, 'filterExcept']);
Route::post('/input/filter/merge', [InputController::class, 'filterMerge']);

// FileController
Route::post('/file/upload', [FileController::class, 'upload']);

// ResponseController
Route::get('/response/hello', [ResponseController::class, 'response']);
Route::get('/response/header', [ResponseController::class, 'header']);

// Error 404
Route::fallback(function () {
    return "Error 404 by Jimmy Wira Arbaa";
});
