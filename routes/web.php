<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', 'HomeController@index')->name('guest-home');

Route::get('/contacts', 'HomeController@contacts')->name('contacts');
Route::post('/contacts', 'HomeController@contactsSent')->name('contacts.sent');

Route::prefix('posts')
    ->group(function() {
        Route::get('/', 'PostController@index')->name('posts.index');
        Route::get('/{slug}', 'PostController@show')->name('posts.show');
    });

Auth::routes();

// Route::get('/admin', 'HomeController@index')->middleware('auth')->name('admin-home');
Route::prefix('admin')
    ->namespace('Admin')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', 'HomeController@index')->name('admin-home');
        Route::get('/profile', 'HomeController@profile')->name('admin-profile');
        Route::post('/profile/generate-token', 'HomeController@generateToken')->name('admin.generate_token');
        Route::resource('/posts', 'PostController')->names([
            'index'=>'admin.posts.index',
            'create'=>'admin.posts.create',
            'destroy'=>'admin.posts.destroy',
            'update'=>'admin.posts.update',
            'show'=>'admin.posts.show',
            'edit'=>'admin.posts.edit',
            'store'=>'admin.posts.store',
            //in alternativa è possibile fissare un prefix nei guest
        ]);
    });

