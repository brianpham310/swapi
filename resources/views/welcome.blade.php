@extends('layouts.app')
@section('content')
    <div class="container p-3">
        <div class="row">
            <div class="col col-12 col-xl-6 border p-3 offset-xl-3">
                <h3 class="mb-4">Choose an action</h3>
                <ul>

                <li>
                    <a href="/characters?film=Return Of The Jedi">Return Of The Jedi's Characters</a></li>
                    <li><a href="/species?type=mammal">Mammals of all films</a></li>
                    <li><a href="/characters/import">Characters Import Interface</a></li>
                    <li><a href="/characters/create">Create a new Character</a></li>
                    <li><a href="/characters/mass-update">Mass update characters Interface</a></li>
                </ul>
            </div>
        </div>
    </div>
@endsection
