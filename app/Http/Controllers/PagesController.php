<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard() {
        $title = [
            'title1' => 'Dashboard',
            'title2' => 'Dashboard'
        ];
        return view('admin.dashboard')->with($title);
    }

    public function registerAdmin() {
        $title = [
            'title1' => 'Register',
            'title2' => 'Register'
        ];
        return view('auth.register')->with($title);
    }

    public function about() {
        $title = [
            'title1' => 'About us',
            'title2' => 'About'
        ];
        return view('admin.about')->with($title);
    }

    public function adverts() {
        $title = [
            'title1' => 'Adverts',
            'title2' => 'Advert'
        ];
        return view('admin.advert')->with($title);
    }

    public function slider() {
        $title = [
            'title1' => 'Sliders',
            'title2' => 'Sliders'
        ];
        return view('admin.slider')->with($title);
    }
}
