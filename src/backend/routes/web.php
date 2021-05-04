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
    return view('posts/index');
});

Route::get('/', [App\Http\Controllers\PostController::class, 'index'])->name('post.list');                 // 一覧表示ページ
Route::get('/post/new', [App\Http\Controllers\PostController::class, 'create'])->name('post.new');              // 新規投稿ページ
Route::post('/post', [App\Http\Controllers\PostController::class, 'store'])->name('post.store');                // 新規保存
Route::get('/post/{id}', [App\Http\Controllers\PostController::class, 'show'])->name('post.show');              // 詳細表示ページ
Route::delete('/post/{id}', [App\Http\Controllers\PostController::class, 'destroy'])->name('post.delete');      // 削除
Route::get('/post/edit/{id}', [App\Http\Controllers\PostController::class, 'edit'])->name('post.edit');         // 編集ページ表示
Route::post('/post/update/{id}', [App\Http\Controllers\PostController::class, 'update'])->name('post.update');  // 更新

Route::group(['middleware' => 'auth'], function() {
    Route::get('/post/{id}', 'PostController@showCreateForm')->name('posts.create');
    Route::post('/post/new', 'PostController@create');
 });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('guest', 'Auth\LoginController@guestLogin')->name('login.guest');