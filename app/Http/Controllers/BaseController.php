<?php

namespace App\Http\Controllers;

use App\Helpers\StarWar;

class BaseController extends Controller
{
    protected $starWarHelper;

    // initialize its starwar helper
    function __construct()
    {
        $this->starWarHelper = new StarWar();
    }

}
