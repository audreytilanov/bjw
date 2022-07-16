<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\NewsAnchorController;
use App\Http\Controllers\Admin\NewsPaperController;
use App\Http\Controllers\Admin\VideosController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PengumpulanController;
use App\Http\Controllers\PjtlnController;
use App\Http\Controllers\SeminarController;

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
Route::post('/features/pengumpulan', [MenuController::class, 'featuresPengumpulan'])->name('user.features.pengumpulan');

Route::post('/guidebook/download', [MenuController::class, 'guidebook'])->name('user.guidebook');
Route::post('/pamflet/download', [MenuController::class, 'pamflet'])->name('user.pamflet');
Route::post('/pamflet/download/features', [MenuController::class, 'pamfletFeatures'])->name('user.pamflet.features');
Route::post('/pamflet/download/videos', [MenuController::class, 'pamfletVideos'])->name('user.pamflet.videos');
Route::post('/pamflet/download/newspaper', [MenuController::class, 'pamfletNewspaper'])->name('user.pamflet.newspaper');
Route::post('/pamflet/download/newsanchor', [MenuController::class, 'pamfletNewsanchor'])->name('user.pamflet.newsanchor');

Route::post('/pamflet/download/seminar', [MenuController::class, 'pamfletSeminar'])->name('user.pamflet.seminar');
Route::post('/pamflet/download/pjtln', [MenuController::class, 'pamfletPjtln'])->name('user.pamflet.pjtln');

Route::post('/guidebook/download/pjtln', [MenuController::class, 'guidebookPjtln'])->name('user.guidebook.pjtln');

Route::get('/seminar', [MenuController::class, 'seminar'])->name('user.seminar');
Route::post('/seminar/submit', [MenuController::class, 'seminarSubmit'])->name('user.seminar.submit');

Route::get('/pjtln', [MenuController::class, 'pjtln'])->name('user.pjtln');
Route::post('/pjtln/submit', [MenuController::class, 'pjtlnSubmit'])->name('user.pjtln.submit');

Route::get('/news-anchor', [MenuController::class, 'newsanchors'])->name('user.newsanchor');
Route::post('/news-anchor/submit', [MenuController::class, 'newsAnchorSubmit'])->name('user.newsanchor.submit');
Route::post('/news-anchor/pengumpulan', [MenuController::class, 'newsAnchorPengumpulan'])->name('user.newsanchor.pengumpulan');


Route::get('/videos', [MenuController::class, 'video'])->name('user.video');
Route::post('/videos/submit', [MenuController::class, 'videoSubmit'])->name('user.video.submit');
Route::post('/videos/pengumpulan', [MenuController::class, 'videosPengumpulan'])->name('user.video.pengumpulan');

Route::get('/mini-news-paper', [MenuController::class, 'miniNewsPaper'])->name('user.mininews');
Route::post('/mini-news-paper/submit', [MenuController::class, 'miniNewsPaperSubmit'])->name('user.mininews.submit');
Route::post('/mini-news-paper/pengumpulan', [MenuController::class, 'miniNewsPaperPengumpulan'])->name('user.mininews.pengumpulan');


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

        Route::prefix('seminar')->name('seminar.')->group(function(){
            Route::get('/',[SeminarController::class, 'index'])->name('index');
            Route::post('/download-pop/{id}',[SeminarController::class, 'downloadpop'])->name('pop');
            Route::post('/download-ktm/{id}',[SeminarController::class, 'downloadktm'])->name('ktm');
            Route::post('/accept/{id}',[SeminarController::class, 'accept'])->name('accept');
            Route::post('/decline/{id}',[SeminarController::class, 'decline'])->name('decline');
            Route::post('/delete/{id}',[SeminarController::class, 'delete'])->name('delete');
        });

        Route::prefix('pjtln')->name('pjtln.')->group(function(){
            Route::get('/',[PjtlnController::class, 'index'])->name('index');
            Route::post('/download-pop/{id}',[PjtlnController::class, 'downloadpop'])->name('pop');
            Route::post('/download-ktm/{id}',[PjtlnController::class, 'downloadktm'])->name('ktm');
            Route::post('/accept/{id}',[PjtlnController::class, 'accept'])->name('accept');
            Route::post('/decline/{id}',[PjtlnController::class, 'decline'])->name('decline');
            Route::post('/delete/{id}',[PjtlnController::class, 'delete'])->name('delete');
        });

        Route::prefix('pengumpulan')->name('pengumpulan.')->group(function(){
            Route::get('/feature',[PengumpulanController::class, 'feature'])->name('feature');
            Route::post('/feature/accept/{id}',[PengumpulanController::class, 'featureAccept'])->name('feature.accept');
            Route::post('/file/{id}',[PengumpulanController::class, 'file'])->name('file');
            Route::get('/newsachor',[PengumpulanController::class, 'newsanchor'])->name('newsanchor');
            Route::post('/newsanchor/accept/{id}',[PengumpulanController::class, 'newsAnchorAccept'])->name('newsanchor.accept');

            Route::get('/video',[PengumpulanController::class, 'video'])->name('video');
            Route::post('/video/accept/{id}',[PengumpulanController::class, 'videoAccept'])->name('video.accept');

        });
    });
});
