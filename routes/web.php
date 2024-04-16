<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;


Route::get('/',[IndexController::class, 'index'])->name('dashboard.index');

Route::middleware(['guest'])->group(function() {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'postlogin'])->name('postlogin');

    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register/post', [RegisterController::class, 'postregister'])->name('postregister');
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('/dashboard')->group(function() {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/album/{id}', [DashboardController::class, 'viewAlbum'])->name('view.album');
        Route::get('/dashboard/sort/{albumId}', [DashboardController::class, 'sortPhotosByAlbum'])->name('dashboard.sort');
        Route::get('/album',[AlbumController::class, 'index'])->name('album');
        Route::post('/album/post',[AlbumController::class, 'post'])->name('album.post');
        Route::get('/foto', [FotoController::class, 'index'])->name('foto');
        Route::post('/foto/post', [FotoController::class, 'postfoto'])->name('foto.post');
        Route::delete('/delete-photo/{id}', [FotoController::class, 'delete'])->name('deletePhoto');
        Route::post('/like/{id}', [FotoController::class, 'like'])->name('like');
        Route::get('/comment/{id}',[CommentsController::class, 'show'])->name('comment');
        Route::post('/add-comment', [CommentsController::class, 'post'])->name('add.comment');
    });
});

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


