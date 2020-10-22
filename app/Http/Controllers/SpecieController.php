<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SpecieController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return void
     */
    public function index(Request $request)
    {
        $data = $request->all();
        abort_if(!isset($data['type']), 404);
        $type = $data['type'];
        $species = $this->starWarHelper->getSpeciesFromAllFilms($data['type']);
        return view('specie.list', compact('species','type'));
    }
}
