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
            Route::post('settings', 'PagesController@storeSetting')->name('setting.store');
            Route::put('settings', 'PagesController@updateSetting')->name('setting.update');

            Route::get('profile', 'PagesController@profile')->name('profile');
            Route::put('profile', 'PagesController@updateProfile')->name('setting.update');

            Route::resource('parentingquiz', "ParentingQuizzesController");
            Route::resource('babyquiz', "BabyQuizzesController");
            Route::resource('babyfact', "BabyFactsController");
            Route::resource('pregnancytips', "PregnancyTipsController");
            Route::resource('parentingtips', "ParentingTipsController");
            Route::resource('childpsychology', "ChildPsychologiesController");
            Route::resource('parentpsychology', "ParentPsychologiesController");
            Route::resource('quotes', "QuotesController");
            Route::resource('suscribers', "SuscribersController", ['only' => ['index', 'update', 'destroy']]);

            //routes to populate database with json files provided by client
            Route::get('/storebabyquiz', "StoreJSONFilesInDBController@storeBabyQuiz");
            Route::get('/storeparentingquiz', "StoreJSONFilesInDBController@storeParentingQuiz");
            Route::get('/storeparentpsychology', "StoreJSONFilesInDBController@storeParentPsychology");
            Route::get('/storechildpsychology', "StoreJSONFilesInDBController@storeChildPsychology");
            Route::get('/storeparentingtips', "StoreJSONFilesInDBController@storeParentingTips");
            Route::get('/storebabyfacts', "StoreJSONFilesInDBController@storeBabyFacts");
            Route::get('/storequotes', "StoreJSONFilesInDBController@storeQuotes");
        });
    });
});



Route::get('/home', 'HomeController@index')->name('home');  //used after registration. cannot find where to override it thats why its still here

//public routes
Route::namespace('Visitors')->group(function() {

    Route::get('/', 'PublicController@index')->name('index');      //logging admin out redirects here
    Route::post('/', 'PublicController@suscribe');

    Route::get('/childpsychology', 'PublicController@childPsychologies')->name('psychologies.child');
    Route::get('/childpyschology/{id}', 'PublicController@childPsychology')->name('psychology.child');

    Route::get('/parentpsychology', 'PublicController@parentPsychologies')->name('psychologies.parent');
    Route::get('/parentpsychology/{id}', 'PublicController@parentPsychology')->name('psychology.parent');

    Route::get('/parentingtips', 'PublicController@parentingTips')->name('tips.parent');
    Route::get('/parentingtips/{id}', 'PublicController@parentingtip')->name('tip.parent');

    Route::get('/pregnancytips', 'PublicController@pregnancyTips')->name('tips.pregnancy');
    Route::get('/pregnancytips/{id}', 'PublicController@pregnancytip')->name('tip.pregnancy');

    Route::get('/babyfacts', 'PublicController@babyFacts')->name('facts.baby');
    Route::get('/babyfacts/{id}', 'PublicController@babyFact')->name('fact.baby');

    Route::get('/parentingquiz', 'ParentingQuizController@index')->name('parentingquiz');
    Route::post('/parentingquiz', 'ParentingQuizController@mark');
    Route::put('/parentingquiz', "ParentingQuizController@sendEbook");

    Route::get('/babyquiz', 'BabyQuizController@index')->name('babyquiz');
    Route::post('/babyquiz', 'BabyQuizController@mark');
    Route::put('/babyquiz', "BabyQuizController@sendEbook");

    Route::get('/contact', 'PublicController@contact')->name('contact');
    Route::post('/contact', 'PublicController@mail');

    Route::get('/quotes', 'PublicController@quotes')->name('quotes');
});

