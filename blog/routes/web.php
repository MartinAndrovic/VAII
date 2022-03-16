<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\UploadController;

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



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/', [App\Http\Controllers\PostController::class, 'index'])->name('postHome');

Route::get('/posts/create', [App\Http\Controllers\PostController::class, 'create'])->middleware('auth');    //route:: get na presmerovanie, vrati formular, get posieka url, z ktorej s natahuju data

Route::get('/posts/{post}', [App\Http\Controllers\PostController::class, 'show'])->name('postById'); // {post } je parameter pre funkciu show v ctrl
Route::get('/posts/{post}/edit', [App\Http\Controllers\PostController::class, 'edit'])->middleware('auth');
Route::get('/user/posts', [App\Http\Controllers\PostController::class, 'indexUser'])->middleware('auth');
Route::get('/user/posts/{post}', [App\Http\Controllers\PostController::class, 'showUser'])->middleware('auth');

Route::post('/posts/', [App\Http\Controllers\PostController::class, 'store'])->middleware('auth');          // html ma len get a post, potom suvisiace, netreba dat celu cestu, lebo je tak definvane
Route::patch('/posts/{post}', [App\Http\Controllers\PostController::class, 'update'])->middleware('auth');
Route::delete("/posts/{post}", [App\Http\Controllers\PostController::class, 'delete'])->middleware('auth');



Route::post('/komentar', [App\Http\Controllers\CommentController::class, 'store']);



Route::get('/kategorie', [App\Http\Controllers\CategoryController::class, 'index']);
Route::get('/kategorie/create', [App\Http\Controllers\CategoryController::class, 'create']);
Route::get('/kategorie/{category}', [App\Http\Controllers\CategoryController::class, 'edit']);
Route::post('/kategorie', [App\Http\Controllers\CategoryController::class, 'store']);
Route::patch('/kategorie/{category}', [App\Http\Controllers\CategoryController::class, 'update']);

//asi nove
Route::view('upload','upload');
Route::post('upload',[UploadController::class,'upl']);

//nove

Route::get('/user/skuska',[App\Http\Controllers\SkuskyController::class, 'index']);
Route::post('/user/skuska', [App\Http\Controllers\SkuskyController::class, 'store']);
Route::get('/user/skuska/{skuska}', [App\Http\Controllers\SkuskyController::class, 'show']);
Route::post('/user/skuska/{skuska}', [App\Http\Controllers\SkuskyController::class, 'storeSk']);
Route::get('/user/skuska/{skuska}/{zadanie}', [App\Http\Controllers\SkuskyController::class, 'showZ']);  //zatial nejde
Route::post('/user/skuska/{skuska}/{zadanie}', [App\Http\Controllers\SkuskyController::class, 'storeZ']);
Route::get('/user/skuska/{skuska}/{zadanie}/{uloha}', [App\Http\Controllers\SkuskyController::class, 'showU']);
Route::post('/user/skuska/{skuska}/{zadanie}/{uloha}', [App\Http\Controllers\SkuskyController::class, 'storeU']);

Route::get('/skuska',[App\Http\Controllers\SkuskyController::class, 'showIn']);
Route::post('/skuska',[App\Http\Controllers\SkuskyController::class, 'storeIn']);

Route::get('/skuska/start',[App\Http\Controllers\SkuskyController::class, 'showEx']);

Route::get('/eval', [App\Http\Controllers\UploadController::class, 'index']);

