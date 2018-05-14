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

Route::get('admin/adverts', 'PagesController@adverts');
Route::get('admin/slider', 'PagesController@slider');

Route::get('admin/settings', 'PagesController@setting');
Route::post('admin/settings', 'PagesController@storeSetting');
Route::put('admin/settings', 'PagesController@updateSetting');

Route::get('admin/profile', 'PagesController@profile');
Route::put('admin/profile', 'PagesController@updateProfile');

Route::resource('admin/parentingquiz', "ParentingQuizzesController");
Route::resource('admin/babyquiz', "BabyQuizzesController");
Route::resource('admin/babyfact', "BabyFactsController");
Route::resource('admin/pregnancytips', "PregnancyTipsController");
Route::resource('admin/parentingtips', "ParentingTipsController");
Route::resource('admin/childpsychology', "ChildPsychologiesController");
Route::resource('admin/parentpsychology', "ParentPsychologiesController");
Route::resource('admin/quotes', "QuotesController");

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');  //used after registration. cannot find where to override it thats why its still here

//public routes
Route::get('/', 'publicController@index');