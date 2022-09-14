<?php

use Illuminate\Support\Facades\Route;

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
});

Route::get('/products/{product}/items/{item}', function ($productId, $itemId) {
    return "Products: " . $productId . ", Items: " . $itemId;
});

Route::get('/category/{category}', function (string $category) {
    return "Category: " . $category;
})->where('category', '[0-9]+');

Route::get('/users/{userId?}', function (string $userId = '404') {
    return "User: " . $userId;
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