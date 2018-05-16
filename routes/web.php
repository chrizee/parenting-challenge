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

//admin routes
// adds "admin/" to the uri of the routes in this group
Route::prefix('admin')->group(function () {
    Auth::routes();     //auth controllers are not not "/admin" directory and not all of them are with the auth middleware

    Route::namespace('Admin')->group(function () {
        // Controllers Within The "App\Http\Controllers\Admin" Namespace
        Route::middleware('auth')->group(function () {
            //all routes in this group are protected with the auth middleware
            //Route::get('/', 'PagesController@dashboard');
            //alternative for the route above since the controller just loads a view with two parameters
            Route::view('/', 'admin.dashboard', ['title1' => 'Dashboard', 'title2' => 'Dashboard'])->name('dashboard');
            Route::get('dashboard', 'PagesController@dashboard')->name('dsahboard1');

            Route::get('register', 'PagesController@registerAdmin')->name('register');

            Route::get('adverts', 'PagesController@adverts')->name('adverts');
            Route::post('adverts', 'PagesController@storeAdverts')->name('adverts.store');
            Route::put('adverts/{id}', 'PagesController@updateAdverts')->name('adverts.update');

            Route::get('settings', 'PagesController@setting')->name('setting');
            Route::post('settings', 'PagesController@storeSetting');
            Route::put('settings', 'PagesController@updateSetting');

            Route::get('profile', 'PagesController@profile')->name('profile');
            Route::put('profile', 'PagesController@updateProfile');

            Route::resource('parentingquiz', "ParentingQuizzesController");
            Route::resource('babyquiz', "BabyQuizzesController");
            Route::resource('babyfact', "BabyFactsController");
            Route::resource('pregnancytips', "PregnancyTipsController");
            Route::resource('parentingtips', "ParentingTipsController");
            Route::resource('childpsychology', "ChildPsychologiesController");
            Route::resource('parentpsychology', "ParentPsychologiesController");
            Route::resource('quotes', "QuotesController");
            Route::resource('suscribers', "SuscribersController", ['only' => ['index', 'update', 'destroy']]);
        });
    });
});



Route::get('/home', 'HomeController@index')->name('home');  //used after registration. cannot find where to override it thats why its still here

//public routes
Route::namespace('Visitors')->group(function() {

    Route::get('/', 'PublicController@index')->name('index');      //logging admin out redirects here

    Route::get('/childpsychology', 'PublicController@childPsychologies')->name('psychologies.child');
    Route::get('/childpyschology/{id}', 'PublicController@childPsychology')->name('psychology.child');

    Route::get('/parentpsychology', 'PublicController@parentPsychologies')->name('psychologies.parent');
    Route::get('/parentpsychology/{id}', 'PublicController@parentPsychology')->name('psychology.parent');
});
