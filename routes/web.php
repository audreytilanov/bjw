<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\NewsAnchorController;
use App\Http\Controllers\Admin\NewsPaperController;
use App\Http\Controllers\Admin\VideosController;
use App\Http\Controllers\MenuController;

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

Route::get('/', [MenuController::class, 'index'])->name('user.index');
Route::get('/email', [MenuController::class, 'email'])->name('user.email');
Route::get('/about', [MenuController::class, 'about'])->name('user.about');
Route::get('/feature', [MenuController::class, 'features'])->name('user.feature');
Route::post('/features/submit', [MenuController::class, 'featuresSubmit'])->name('user.features.submit');

Route::post('/guidebook/download', [MenuController::class, 'guidebook'])->name('user.guidebook');
Route::post('/pamflet/download', [MenuController::class, 'pamflet'])->name('user.pamflet');
Route::post('/pamflet/download/features', [MenuController::class, 'pamfletFeatures'])->name('user.pamflet.features');
Route::post('/pamflet/download/videos', [MenuController::class, 'pamfletVideos'])->name('user.pamflet.videos');
Route::post('/pamflet/download/newspaper', [MenuController::class, 'pamfletNewspaper'])->name('user.pamflet.newspaper');
Route::post('/pamflet/download/newsanchor', [MenuController::class, 'pamfletNewsanchor'])->name('user.pamflet.newsanchor');

Route::get('/news-anchor', [MenuController::class, 'newsanchors'])->name('user.newsanchor');
Route::post('/news-anchor/submit', [MenuController::class, 'newsAnchorSubmit'])->name('user.newsanchor.submit');

Route::get('/videos', [MenuController::class, 'video'])->name('user.video');
Route::post('/videos/submit', [MenuController::class, 'videoSubmit'])->name('user.video.submit');

Route::get('/mini-news-paper', [MenuController::class, 'miniNewsPaper'])->name('user.mininews');
Route::post('/mini-news-paper/submit', [MenuController::class, 'miniNewsPaperSubmit'])->name('user.mininews.submit');

Route::prefix('superadmin')->name('admin.')->group(function(){
    Route::middleware(['guest:web'])->group(function(){
        // Login and redirected miss-uRL
        Route::view('/login', 'admin.login')->name('login');
        Route::get('/admin', [AdminLoginController::class, 'redirectLogin']);
        Route::get('/', [AdminLoginController::class, 'redirectLogin']);

        // Admin Login
        Route::post('/account/check', [AdminLoginController::class, 'check'])->name('check');
    }); 

    Route::middleware(['auth:web'])->group(function(){
        Route::get('/dashboard', [AdminController::class, 'home'])->name('home');
        Route::post('/account/logout', [AdminLoginController::class, 'logout'])->name('logout');

        // KATEGORI
        Route::prefix('features')->name('features.')->group(function(){
            Route::get('/',[FeatureController::class, 'index'])->name('index');
            Route::post('/download-pop/{id}',[FeatureController::class, 'downloadpop'])->name('pop');
            Route::post('/download-ktm/{id}',[FeatureController::class, 'downloadktm'])->name('ktm');
            Route::post('/accept/{id}',[FeatureController::class, 'accept'])->name('accept');
            Route::post('/decline/{id}',[FeatureController::class, 'decline'])->name('decline');
            Route::post('/delete/{id}',[FeatureController::class, 'delete'])->name('delete');
        });

        Route::prefix('newsanchor')->name('newsanchor.')->group(function(){
            Route::get('/',[NewsAnchorController::class, 'index'])->name('index');
            Route::post('/download-pop/{id}',[NewsAnchorController::class, 'downloadpop'])->name('pop');
            Route::post('/download-ktm/{id}',[NewsAnchorController::class, 'downloadktm'])->name('ktm');
            Route::post('/accept/{id}',[NewsAnchorController::class, 'accept'])->name('accept');
            Route::post('/decline/{id}',[NewsAnchorController::class, 'decline'])->name('decline');
            Route::post('/delete/{id}',[NewsAnchorController::class, 'delete'])->name('delete');
        });

        Route::prefix('videos')->name('videos.')->group(function(){
            Route::get('/',[VideosController::class, 'index'])->name('index');
            Route::post('/download-pop/{id}',[VideosController::class, 'downloadpop'])->name('pop');
            Route::post('/download-ktm/{id}',[VideosController::class, 'downloadktm'])->name('ktm');
            Route::post('/accept/{id}',[VideosController::class, 'accept'])->name('accept');
            Route::post('/decline/{id}',[VideosController::class, 'decline'])->name('decline');
            Route::post('/delete/{id}',[VideosController::class, 'delete'])->name('delete');
        });

        Route::prefix('newspaper')->name('newspaper.')->group(function(){
            Route::get('/',[NewsPaperController::class, 'index'])->name('index');
            Route::post('/download-pop/{id}',[NewsPaperController::class, 'downloadpop'])->name('pop');
            Route::post('/download-ktm/{id}',[NewsPaperController::class, 'downloadktm'])->name('ktm');
            Route::post('/accept/{id}',[NewsPaperController::class, 'accept'])->name('accept');
            Route::post('/decline/{id}',[NewsPaperController::class, 'decline'])->name('decline');
            Route::post('/delete/{id}',[NewsPaperController::class, 'delete'])->name('delete');
        });
    });
});
