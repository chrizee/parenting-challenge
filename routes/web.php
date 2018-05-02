<?php

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
//admin routes
Route::get('/admin', 'PagesController@dashboard');
Route::get('/admin/dashboard', 'PagesController@dashboard');
Route::get('/admin/register', 'PagesController@registerAdmin');
Route::resource('admin/parentingquiz', "ParentingQuizzesController");
Route::resource('admin/babyquiz', "BabyQuizzesController");
