<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Character extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'height',
        'mass',
        'hair_color',
        'skin_color',
        'birth_year',
        'gender',
        'homeworld_name',
        'species_name',
    ];

    /**
     * @var array
     */
    protected $_validation = [
        'name' => 'required|unique:App\Models\Character,name|string',
        'height' => 'required|numeric',
        'mass' => 'required|numeric',
        'hair_color' => 'required|string',
        'birth_year' => 'required|string',
        'skin_color' => 'required|string',
        'gender' => 'required|string',
        'homeworld_name' => 'required|string',
        'species_name' => 'required|string',
    ];

    /**
     * Get a list of distinct specie names
     */
    public static function getSpeciesNames(){
        return self::distinct('species_name')->pluck('species_name');
    }

    /**
     * Get a list of distinct homeworld names
     */
    public static function getHomeWorldNames(){
        return self::distinct('homeworld_name')->pluck('homeworld_name');
    }
}
