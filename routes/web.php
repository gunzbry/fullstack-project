<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\AdminController;

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

Route::post('app/create_tag', [AdminController::class, 'addTag']);
Route::get('app/get_tags', [AdminController::class, 'getTag']);
Route::post('app/edit_tag', [AdminController::class, 'editTag']);
Route::post('app/delete_tag', [AdminController::class, 'deleteTag']);


Route::get('/', function () {
    return view('welcome');
});

// Route::get('/new', [TestController::class, 'controllerMethod']);

// Default page. if not found, render the default blade
Route::any('{slug}', function(){
    return view('welcome');
    //can call a controller method and return view as well
});
