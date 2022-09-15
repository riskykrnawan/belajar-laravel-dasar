<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\InputController;

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