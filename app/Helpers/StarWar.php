<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;

class StarWar
{
    const BASE_URL = 'https://swapi.dev/api/';
    protected $requestHelper;

    function __construct()
    {
        $this->requestHelper = new ConcurrentRequest();
    }

    /**
     * @param string $endpoint
     * @param int $page
     * @param string $keyword
     * @return array|\Illuminate\Http\Client\Response|mixed
     */
    public function get(string $endpoint, string $keyword = '', int $page = -1)
    {
        $url = self::BASE_URL . $endpoint;
        if ($keyword) {
            $url .= "?search=$keyword";
        }
        $urlNoPage = $url;
        if ($page > 0) {
            $url .= $keyword ? "&page=$page" : "?page=$page";
        }
        $res = Http::get($url);
        if ($res) {
            $res = $this->decodeResponse($res);
            // if getting all data from all pages
            if ($page < 0) {
                // check if there are more pages
                $numberOfMorePages = intval($res['count'] / 10 + 1);
                // construct urls
                $pageUrls = [];
                for ($i = 2; $i <= $numberOfMorePages; $i++) {
                    $pageUrls[] = $urlNoPage . '?page=' . $i;
                }
                // get the rest of data from the urls
                $pool = $this->requestHelper->getPool($pageUrls, function ($result) use (&$res) {
                    // append new data
                    $res['results'] = array_merge($res['results'], $result['results']);
                });
                $promise = $pool->promise();
                $promise->wait();
            }
        }
        return $res && isset($res['results']) ? $res['results'] : [];
    }

    /**
     * Get characters of a film
     * @param string $film
     * @return array
     */
    public function getCharactersFromAFilm(string $film)
    {
        if (!$film) {
            return [];
        }
        $characters = [];
        // get the film
        $res = $this->get('films', $film);
        // get character api url
        $characterUrls = $res[0]['characters'];
        // send concurrent requests to get characters' names
        $pool = $this->requestHelper->getPool($characterUrls, function ($result) use (&$characters) {
            $characters[] = $result['name'];
        });
        $promise = $pool->promise();
        $promise->wait();

        return $characters;
    }

    /**
     * Get all species of a type from all films
     * @param string $type
     * @return array
     */
    public function getSpeciesFromAllFilms(string $type)
    {
        if (!$type) {
            return [];
        }
        $namesAndHomeWorlds = [];
        $homeWorldUrlsSpecies = [];
        $res = $this->get('species');
        foreach ($res as $specie) {
            if ($specie['classification'] == $type) {
                $homeWorldUrlsSpecies[$specie['homeworld']] = $specie['name'];
            }
        }
        // get name of homeworlds
        $pool = $this->requestHelper->getPool(array_keys($homeWorldUrlsSpecies),
            function ($result) use (&$namesAndHomeWorlds, $homeWorldUrlsSpecies) {
                if (key_exists($result['url'], $homeWorldUrlsSpecies)) {
                    $namesAndHomeWorlds[$homeWorldUrlsSpecies[$result['url']]] = $result['name'];
                }
            });
        $promise = $pool->promise();
        $promise->wait();
        return $namesAndHomeWorlds;
    }

    /**
     * Get characters and their details
     * @return array
     */
    public function getCharactersDetails()
    {
        $characterDetailArr = [];
        $charactersSpecies = [];
        $charactersHomeWorlds = [];
        $res = $this->get('people');
        // for each of the character --> get species and homeworld name
        foreach ($res as $character) {
            // let urls of characters to be the key
            // coz they are unique
            $characterDetailArr[$character['url']] = [
                'name' => $character['name'],
                'height' => $character['height'],
                'mass' => $character['mass'],
                'hair_color' => $character['hair_color'],
                'skin_color' => $character['skin_color'],
                'birth_year' => $character['birth_year'],
                'gender' => $character['gender'],
                'species_name' => [],
                'homeworld_name' => '',
            ];
            // if there are species
            if (count($character['species'])) {
                foreach ($character['species'] as $specie) {
                    $charactersSpecies[$specie] = $character['url'];
                }
            }
            // if there are homeworld
            if ($character['homeworld']) {
                $charactersHomeWorlds[$character['homeworld']] = $character['url'];
            }
        }
        // now get species and homeworld
        $homeworldAndSpecieUrls = array_merge(array_keys($charactersSpecies), array_keys($charactersHomeWorlds));
        $pool = $this->requestHelper->getPool($homeworldAndSpecieUrls,
            function ($result) use (&$characterDetailArr, $charactersSpecies, $charactersHomeWorlds) {
                // store result
                // if result contains specie data
                if (key_exists($result['url'], $charactersSpecies)) {
                    // store specie's name to the character detail array
                    $characterDetailArr[$charactersSpecies[$result['url']]]['species_name'][] = $result['name'];
                } // if result contains homeworld data
                elseif (key_exists($result['url'], $charactersHomeWorlds)) {
                    // store homeworld's name to the character detail array
                    $characterDetailArr[$charactersHomeWorlds[$result['url']]]['homeworld_name'] = $result['name'];
                }
            });
        $promise = $pool->promise();
        $promise->wait();

        // for species --> there maybe multiple names (based on the data on Swapi) --> need to
        // concat those names into 1 string
        foreach ($characterDetailArr as $key => $character){
            $characterDetailArr[$key]['species_name'] = implode(",", $character['species_name']);
        }
        return $characterDetailArr;
    }

    /**
     * @param Response $res
     * @return array
     */
    public function decodeResponse(Response $res)
    {
        $res = $res->getBody()->getContents();
        return json_decode($res, true);
    }
}
