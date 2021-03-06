<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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
Route::get('/', [HomeController::class, 'show']);
Route::get('/u/logout', [HomeController::class, 'logout']);
Route::get('/lang/{lang}', [HomeController::class, 'setLang']);

// Route::get('/', function () {
//     return view('info');

// });

// Route::get('/a', function () {
//     return view('info');
// });
