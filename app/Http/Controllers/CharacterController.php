<?php

namespace App\Http\Controllers;

use App\Models\Character;
use Illuminate\Http\Request;
use App\Helpers\File as FileHelper;

class CharacterController extends BaseController
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
        abort_if(!isset($data['film']), 404);
        // make a request to Swapi
        $characterNames = $this->starWarHelper->getCharactersFromAFilm($data['film']);
        return view('character.list', compact('characterNames'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $speciesNames = Character::getSpeciesNames();
        $homeWorldNames = Character::getHomeWorldNames();

        return view('character.create', compact('speciesNames', 'homeWorldNames'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:App\Models\Character,name|string',
            'height' => 'required|numeric',
            'mass' => 'required|numeric',
            'hair_color' => 'required|string',
            'birth_year' => 'required|string',
            'skin_color' => 'required|string',
            'gender' => 'required|string',
            'homeworld_name' => 'required|string',
            'species_name' => 'required|string',
        ]);
        Character::create($validatedData);
        return redirect()->back()->with('message', 'Character has been successfully created');
    }

    /**
     * Get characters and their details from SWAPI
     * @return array
     */
    public function getRemoteCharacters()
    {
        $characterList = $this->starWarHelper->getCharactersDetails();
        if (is_array($characterList)) {
            return array_values($characterList);
        }
    }

    /**
     * Get characters and their details from local database
     * @return array
     */
    public function getLocalCharacters()
    {
        return Character::all();
    }

    /**
     * Import data from Swapi
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function import(Request $request)
    {

        // wipe people currently in the db
        Character::truncate();
        $people = $request->all();
        // some data items from SWAPI are corrupted
        // need to filter out those invalid rows
        foreach ($people as $person) {
            $validator = \Illuminate\Support\Facades\Validator::make($person, [
                    'name' => 'required|unique:App\Models\Character,name|string',
                    'height' => 'required|numeric',
                    'mass' => 'required|numeric',
                    'hair_color' => 'required|string',
                    'birth_year' => 'required|string',
                    'skin_color' => 'required|string',
                    'gender' => 'required|string',
                    'homeworld_name' => 'required|string',
                    'species_name' => 'required|string',
                ]
            );
            if (!$validator->fails()) {
                Character::create($person);
            }
        }

        return response('Data imported successfully', 200);
    }

    /**
     * Update multiple characters read from a csv file
     */
    public function massUpdate()
    {
        $file = public_path('files/characters_to_update.csv');
        $characterArr = FileHelper::csvToArray($file);
        $validSpecies = implode(",", Character::getSpeciesNames()->toArray());
        $validHomeWorlds = implode(",", Character::getHomeWorldNames()->toArray());
        foreach ($characterArr as $character) {
            $validator = \Illuminate\Support\Facades\Validator::make($character, [
                    'height' => 'sometimes|numeric',
                    'mass' => 'sometimes|numeric',
                    'hair_color' => 'sometimes|string',
                    'birth_year' => 'sometimes|string',
                    'skin_color' => 'sometimes|string',
                    'gender' => 'sometimes|string',
                    'homeworld_name' => "sometimes|string|in:$validHomeWorlds",
                    'species_name' => "sometimes|string|in:$validSpecies",
                ]
            );
            if (!$validator->fails()) {
                // get the characters with name
                $characterRecord = Character::where('name', '=', $character['name'])->first();
                if ($characterRecord) {
                    $characterRecord->fill($character);
                    $characterRecord->save();
                }
            }
        }
        return response('Mass Update succeeded');
    }
}
