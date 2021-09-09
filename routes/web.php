<?php

use App\Http\Controllers\MyController;
use Colin\Log\LogSplit;
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

Route::get('/', function (LogSplit $a) {
    $a->dump('@@@');
    return view('welcome');
});
Route::get('/aaa', [MyController::class, 'index']);

