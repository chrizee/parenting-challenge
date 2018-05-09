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

/*Route::get('/', function () {
    return view('welcome');
});*/
//admin routes
Route::get('/', 'PagesController@dashboard');
Route::get('/admin', 'PagesController@dashboard');
Route::get('/admin/dashboard', 'PagesController@dashboard');
Route::get('/admin/register', 'PagesController@registerAdmin');
Route::get('admin/about', 'PagesController@about');
Route::get('admin/adverts', 'PagesController@adverts');
Route::get('admin/slider', 'PagesController@slider');

Route::get('admin/profile', 'ProfileController@index');

Route::resource('admin/parentingquiz', "ParentingQuizzesController");
Route::resource('admin/babyquiz', "BabyQuizzesController");
Route::resource('admin/babyfact', "BabyFactsController");
Route::resource('admin/pregnancytips', "PregnancyTipsController");
Route::resource('admin/parentingtips', "ParentingTipsController");

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');
