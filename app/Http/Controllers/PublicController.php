<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    protected $viewPath = 'public.';

    public function index() {
        return view($this->viewPath."index");
    }
}
