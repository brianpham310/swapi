<?php

namespace App\Http\Controllers;

use App\Helpers\StarWar;

class BaseController extends Controller
{
    protected $starWarHelper;

    function __construct()
    {
        $this->starWarHelper = new StarWar();
    }

}
