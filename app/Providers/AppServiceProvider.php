<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Pages;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Request $request)
    {
        Schema::defaultStringLength(191);
        //share the base path to all views so class 'active can be used in the side bar when in a current location
        $path = '';$show = true;
        $arr = explode('/', $request->path());
        if(count($arr) >=2 && $arr[0] == 'admin') {
            $path = $arr[1];
        }
        if(count($arr) >=2 && $arr[0] != 'admin') {
            $show = false;
        }
        if(count($arr) == 1) $path = $arr[0];
        View::share(['path' => $path, 'show' => $show]);

        //for public views make social media links available to all views
        $pages = Pages::latest()->take(1)->get();
        $pages = (empty($pages[0])) ? $pages : $pages[0];
        View::share('pages', $pages);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
