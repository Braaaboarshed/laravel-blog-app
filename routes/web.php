<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;


Route::get('login', [AuthController::class, 'showLoginForm'])->middleware('guest')->name('login.form');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/', function () {
    return redirect()->route('posts.index');
});
Route::middleware('auth')->resource('posts', PostController::class);

Route::middleware('auth')->resource('tags', TagController::class);
Route::middleware('auth')->group(function () {
    //   
    Route::get('/user/{user}', [UserController::class, 'show'])->name('user.profile');

    //    
    Route::get('/user/{user}/edit', [UserController::class, 'edit'])->name('user.edit');

    //   
    Route::put('/user/{user}/', [UserController::class, 'update'])->name('user.update');
});
// Route::middleware('auth')->put('/user/{user}', [UserController::class, 'update'])->name('user.update');
// Route::middleware('auth')->get('/user/{user}', [UserController::class, 'show'])->name('user.profile');

//   routes/web.php

Route::middleware('auth')->resource('categories', CategoryController::class);

Route::middleware('auth')->resource('comments', CommentController::class);


Route::middleware('auth')->post('/posts/{postId}/comments', [CommentController::class, 'store'])->name('comments.store');
