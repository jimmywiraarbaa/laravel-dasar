<?php

use App\Exceptions\ValidationException;
use App\Http\Controllers\CookieController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\InputController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\SessionController;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

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
Route::controller(RedirectController::class)->prefix('/redirect/')->group(function () {
    Route::get('/to', 'redirectTo');
    Route::get('/from', 'redirectFrom');
    Route::get('/name', 'redirectName')->name('redirect-Name');
    Route::get('/name/{name}', 'redirectHello')->name('redirect-Hello');
    Route::get('/action', 'redirectAction');
    Route::get('/away/youtube', 'redirectAway');
});


// Middleware
Route::middleware(['example:JWA, 401'])->prefix('/middleware')->group(function () {
    Route::get('/api', function () {
        return "OK";
    });

    //Middleware Group
    Route::get('/group', function () {
        return "Group";
    });

    //Middleware Parameter
    Route::get('/parameter', function () {
        return "Parameter";
    });
});


// FormController
Route::get('/form', [FormController::class, 'form']);
Route::post('/form', [FormController::class, 'submitForm']);

// URL Generation
Route::get('/url/current', function () {
    return URL::full();
});

Route::get('/url/named', function () {
    return URL::route('redirect-Hello', ['name' => 'Jimmy']);
});

Route::get('/url/action', function () {
    // return action([FormController::class, 'form'], []);
    // return url()->action([FormController::class, 'form'], []);
    return URL::action([FormController::class, 'form'], []);
});


// Session Controller
Route::get('/session/create', [SessionController::class, 'createSession']);
Route::get('/session/get', [SessionController::class, 'getSession']);

// Error Handler
Route::get('/error/sample', function () {
    throw new Exception("Sample Error");
});

// Error Report Manual
Route::get('/error/manual', function () {
    report(new Exception("Sample Error"));
    return "OK";
});

// Ignore Exception
Route::get('/error/validation', function () {
    throw new ValidationException("Validation Error");
});


// Error 400
Route::get('/abort/400', function () {
    abort(400, "Ups Validation Error");
});


// Error 401
Route::get('/abort/401', function () {
    abort(401);
});


// Error 500
Route::get('/abort/500', function () {
    abort(500);
});


// Error 404
Route::fallback(function () {
    return "Error 404 by Jimmy Wira Arbaa";
});
