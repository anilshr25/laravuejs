<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\RoleController;
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


Route::get('/logout', [HomeController::class, 'logout']);
Route::any('{slug}', [HomeController::class, 'index']);
Route::post('/user/login', [UserController::class, 'login']);

Route::middleware('AdminCheck')->group(function () {
    Route::get('/user/get', [UserController::class, 'getUser']);
    Route::post('/user/add', [UserController::class, 'addUser']);
    Route::post('/user/edit', [UserController::class, 'editUser']);
    Route::post('/user/delete', [UserController::class, 'deleteUser']);

    Route::get('/', [HomeController::class, 'index']);

    Route::post('/tag/add', [TagController::class, 'addTag']);
    Route::get('/tag/get', [TagController::class, 'getTag']);
    Route::post('/tag/edit', [TagController::class, 'editTag']);
    Route::post('/tag/delete', [TagController::class, 'deleteTag']);

    Route::post('/role/add', [RoleController::class, 'addRole']);
    Route::get('/role/get', [RoleController::class, 'getRole']);
    Route::post('/role/edit', [RoleController::class, 'editRole']);
    Route::post('/role/delete', [RoleController::class, 'deleteRole']);
    Route::post('/role/assign', [RoleController::class, 'assignRole']);


    Route::post('/category/add', [CategoryController::class, 'addCategory']);
    Route::post('/category/edit', [CategoryController::class, 'editCategory']);
    Route::get('/category/get',[CategoryController::class, 'getCategory']);
    Route::post('/category/delete',[ImageController::class, 'deleteCategory']);

    Route::post('/image/upload/{uploadFor}',[ImageController::class, 'uploadImg']);
    Route::post('/image/delete_img',[ImageController::class, 'deleteImg']);

});
