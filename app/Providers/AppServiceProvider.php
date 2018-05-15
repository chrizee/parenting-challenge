<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

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
        //share the base path to all views so class 'acive can be used in the side bar when in a current location
        $path = '';
        $arr = explode('/', $request->path());
        if(count($arr) >=2 && $arr[0] == 'admin') {
            $path = $arr[1];
        }
        if(count($arr) == 1) $path = $arr[0];
        View::share('path', $path);
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
