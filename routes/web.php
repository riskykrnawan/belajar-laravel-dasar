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

Route::fallback(function() {
    return '404';
});