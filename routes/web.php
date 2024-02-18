<?php

use App\Http\Controllers\CookieController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\InputController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\ResponseController;
use App\Http\Middleware\VerifyCsrfToken;
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
Route::prefix('/input/')->group(function () {
    Route::get('/hello', [InputController::class, 'hello']);
    Route::post('/hello', [InputController::class, 'hello']);
    Route::post('/hello/first', [InputController::class, 'helloFirstName']);
    Route::post('/hello/input', [InputController::class, 'helloInput']);
    Route::post('/hello/array', [InputController::class, 'arrayInput']);
    Route::post('/type', [InputController::class, 'inputType']);
    Route::post('/filter/only', [InputController::class, 'filterOnly']);
    Route::post('/filter/except', [InputController::class, 'filterExcept']);
    Route::post('/filter/merge', [InputController::class, 'filterMerge']);
});

// FileController
Route::post('/file/upload', [FileController::class, 'upload'])
    ->withoutMiddleware([VerifyCsrfToken::class]);

// ResponseController
Route::prefix('/response/')->group(function () {
    Route::get('/hello', [ResponseController::class, 'response']);
    Route::get('/header', [ResponseController::class, 'header']);
});

Route::prefix('/response/type/')->group(function () {
    Route::get('/view', [ResponseController::class, 'responseView']);
    Route::get('/json', [ResponseController::class, 'responseJson']);
    Route::get('/file', [ResponseController::class, 'responseFile']);
    Route::get('/download', [ResponseController::class, 'responseDownload']);
});

// CookieController
Route::prefix('/cookie/')->group(function () {
    Route::get('/set', [CookieController::class, 'createCookie']);
    Route::get('/get', [CookieController::class, 'getCookie']);
    Route::get('/clear', [CookieController::class, 'clearCookie']);
});


// RedirectController
Route::prefix('/redirect/')->group(function () {
    Route::get('/to', [RedirectController::class, 'redirectTo']);
    Route::get('/from', [RedirectController::class, 'redirectFrom']);
    Route::get('/name', [RedirectController::class, 'redirectName'])->name('redirect-Name');
    Route::get('/name/{name}', [RedirectController::class, 'redirectHello'])->name('redirect-Hello');
    Route::get('/action', [RedirectController::class, 'redirectAction']);
    Route::get('/away/youtube', [RedirectController::class, 'redirectAway']);
});


// Middleware
Route::prefix('/middleware/')->group(function () {
    Route::get('/api', function () {
        return "OK";
    })->middleware(['example:JWA, 401']);

    //Middleware Group
    Route::get('/group', function () {
        return "Group";
    })->middleware(['jwa']);

    //Middleware Parameter
    Route::get('/parameter', function () {
        return "Parameter";
    })->middleware(['example:Jimmy, 401']);
});


// FormController
Route::get('/form', [FormController::class, 'form']);
Route::post('/form', [FormController::class, 'submitForm']);

// Error 404
Route::fallback(function () {
    return "Error 404 by Jimmy Wira Arbaa";
});
