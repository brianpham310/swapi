@extends('layouts.app')
@section('content')
    <div class="container p-3">
        <div class="row">
            <div class="col col-12 col-xl-6 border p-3 offset-xl-3">
                <h3 class="mb-4">New Character</h3>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
                <form method="POST" action="/characters">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input id="name" required class="form-control" type="text" name="name" placeholder="give an unique name">
                    </div>
                    <div class="form-group">
                        <label for="height">Height</label>
                        <input type="number" min="0" step="0.1" increrequired class="form-control" name="height"id="height" placeholder="enter a number">
                    </div>
                    <div class="form-group">
                        <label for="mass">Mass</label>
                        <input type="number" min="0" step="0.1" required class="form-control" name="mass" id="mass" placeholder="enter a number">
                    </div>
                    <div class="form-group">
                        <label for="hair-color">Hair Color</label>
                        <input type="text" required class="form-control" name="hair_color" id="hair-color" placeholder="ex: pink, blue, ...etc">
                    </div>
                    <div class="form-group">
                        <label for="skin-color">Skin Color</label>
                        <input type="text" required class="form-control" name="skin_color" id="skin-color" placeholder="ex: pink, blue, ...etc">
                    </div>
                    <div class="form-group">
                        <label for="birth_year">Birth Year</label>
                        <input type="text" required class="form-control" name="birth_year"id="birth_year" placeholder="ex 1YBB">
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <input type="text" required class="form-control" id="gender" name="gender" placeholder="ex: male, female">
                    </div>
                    <div class="form-group">
                        <label for="homeworld_name">HomeWorld Name</label>
                        <select class="form-control" id="homeworld_name" name="homeworld_name" required>
                            <option disabled>Select 1 name</option>
                            @foreach($homeWorldNames as $name)
                                <option>{{$name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="species_name">Specie Name</label>
                        <select class="form-control" id="species_name" name="species_name" required>
                            <option disabled>Select 1 name</option>
                            @foreach($speciesNames as $name)
                                <option>{{$name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
