<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
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
        return view('admin.register')->with($title);
    }
}
