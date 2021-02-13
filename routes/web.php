<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
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
    return view('mainapp');
});

Route::any('{slug}', function ($id) {
    return view('mainapp');
});
// Auth::routes();

Route::post('/tag/add', [TagController::class, 'addTag']);
Route::get('/tag/get', [TagController::class, 'getTag']);
Route::post('/tag/edit', [TagController::class, 'updateTag']);
Route::post('/tag/delete', [TagController::class, 'deleteTag']);

Route::post('/category/add', [CategoryController::class, 'addCategory']);
Route::post('/category/edit', [CategoryController::class, 'editCategory']);
Route::get('/category/get',[CategoryController::class, 'getCategory']);
Route::post('/category/delete',[CategoryController::class, 'deleteCategory']);
Route::post('/category/upload',[CategoryController::class, 'uploadImg']);
Route::post('/category/delete_img',[CategoryController::class, 'getDeleteImg']);
