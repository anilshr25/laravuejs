<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
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

// Route::get('/', function () {
//     return view('mainapp');
// });

// Route::any('{slug}', function ($id) {
//     return view('mainapp');
// });

Route::get('/', [HomeController::class, 'index']);
Route::get('/logout', [HomeController::class, 'logout']);
Route::any('{slug}', [HomeController::class, 'index']);

Route::post('/user/login', [UserController::class, 'login']);
Route::get('/user/get', [UserController::class, 'getUser']);
Route::post('/user/add', [UserController::class, 'addUser']);
Route::post('/user/edit', [UserController::class, 'editUser']);
Route::post('/user/delete', [UserController::class, 'deleteUser']);


Route::post('/tag/add', [TagController::class, 'addTag']);
Route::get('/tag/get', [TagController::class, 'getTag']);
Route::post('/tag/edit', [TagController::class, 'editTag']);
Route::post('/tag/delete', [TagController::class, 'deleteTag']);

Route::post('/category/add', [CategoryController::class, 'addCategory']);
Route::post('/category/edit', [CategoryController::class, 'editCategory']);
Route::get('/category/get',[CategoryController::class, 'getCategory']);
Route::post('/category/delete',[CategoryController::class, 'deleteCategory']);
Route::post('/category/upload',[CategoryController::class, 'uploadImg']);
Route::post('/category/delete_img',[CategoryController::class, 'getDeleteImg']);
