<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\WebsiteController;
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
    return view('welcome');
});

Auth::routes();

Route::get('/', [WebsiteController::class, 'index'])->name('index');
Route::get('category/{slug}', [WebsiteController::class, 'category'])->name('category');
Route::get('post/{slug}', [WebsiteController::class, 'post'])->name('post');
Route::get('page/{slug}', [WebsiteController::class, 'page'])->name('page');
Route::get('contact', [WebsiteController::class, 'showContactForm'])->name('contact.show');
Route::post('contact', [WebsiteController::class, 'contact'])->name('contact.create');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('posts', PostController::class);
    Route::resource('galleries', GalleryController::class);
    Route::resource('pages', PageController::class);
});

