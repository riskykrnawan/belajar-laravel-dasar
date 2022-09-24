<?php

use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\InputController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\CookieController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\RedirectController;
use App\Http\Middleware\ContohMiddleware;
use App\Http\Middleware\VerifyCsrfToken;

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
    return view('welcome');
});
Route::get('/risky', function () {
    return 'risky';
});
Route::redirect('riskykurniawan', 'risky');

Route::view('/hello1', 'hello', ['name' => 'risky']);

Route::get('/hello2', function () {
    return view('hello', ['name' => 'risky']);
});

Route::get('/hello-world', function () {
    return view('hello.world');
});

Route::get('/products/{id}', function ($productId) {
    return "Products: " . $productId;
})->name('product.detail');

Route::get('/products/{product}/items/{item}', function ($productId, $itemId) {
    return "Products: " . $productId . ", Items: " . $itemId;
})->name('product.item.detail');

Route::get('/category/{category}', function (string $category) {
    return "Category: " . $category;
})->where('category', '[0-9]+')->name('category.detail');;

Route::get('/users/{userId?}', function (string $userId = '404') {
    return "User: " . $userId;
})->name('user.detail');;

Route::get('/produk/{produkId}', function ($produkId) {
    $link = route('product.detail', ['id' => $produkId]);
    return "Link: " . $link;
});

Route::get('/produk-redirect/{produkId}', function ($produkId) {
    return redirect()->route('product.detail', array('id' => $produkId));
});

Route::get('/conflict/{name?}', function (string $name) {
    return "conflict: " . $name;
});

Route::get('/conflict/risky', function () {
    return "conflict: risky 2";
});


Route::fallback(function() {
    return '404';
});

Route::get('/controller/hello/request', [HelloController::class, 'request']);
Route::get('/controller/hello/{name}', [HelloController::class, 'hello']);

Route::get('/input/hello', [InputController::class, 'hello']);
Route::Post('/input/hello', [InputController::class, 'hello']);
Route::get('/input/hello/firstname', [InputController::class, 'helloFirst']);
Route::get('/input/hello/lastname', [InputController::class, 'helloLast']);
Route::get('/input/hello/input', [InputController::class, 'helloInput']);
Route::get('/input/hello/array', [InputController::class, 'arrayInput']);
Route::post('/input/type', [InputController::class, 'inputType']);
Route::post('/input/filter/only', [InputController::class, 'filterOnly']);
Route::post('/input/filter/except', [InputController::class, 'filterExpect']);
Route::post('/input/filter/merge', [InputController::class, 'filterMerge']);

Route::post('/file/upload', [FileController::class, 'upload'])
    ->withoutMiddleware([VerifyCsrfToken::class]);

Route::get('response/hello', [ResponseController::class, 'response']);
Route::get('response/header', [ResponseController::class, 'header']);
Route::get('response/type/view', [ResponseController::class, 'responseView']);
Route::get('response/type/json', [ResponseController::class, 'responseJson']);
Route::get('response/type/file', [ResponseController::class, 'responseFile']);
Route::get('response/type/download', [ResponseController::class, 'responseDownload']);

Route::get('/cookie/set', [CookieController::class, 'createCookie']);
Route::get('/cookie/get', [CookieController::class, 'getCookie']);
Route::get('/cookie/clear', [CookieController::class, 'clearCookie']);

Route::get('/redirect/from', [RedirectController::class, 'redirectFrom']);
Route::get('/redirect/to', [RedirectController::class, 'redirectTo']);
Route::get('/redirect/name', [RedirectController::class, 'redirectName']);
Route::get('/redirect/name/{name}', [RedirectController::class, 'redirectHello'])->name('redirect-hello');
Route::get('/redirect/action', [RedirectController::class, 'redirectAction']);
Route::get('/redirect/away', [RedirectController::class, 'redirectAway']);

Route::get('middleware/api', function () {
    return 'OK';
})->middleware(['contoh:RK,401']); //menggunakan alias, bisa juga menggunakan classnya

Route::get('middleware/group', function () {
    return 'GROUP';
})->middleware(['rk']);

Route::get('middleware/api-with-param', function () {
    return 'PARAM';
})->middleware(['contoh:RK,401']);

Route::get('/form', [FormController::class, 'form']);
Route::post('/form', [FormController::class, 'submitForm']);