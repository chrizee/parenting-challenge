<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    protected $noImage = 'noimage.png';
    protected  $noUser = 'nouser.png';

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
