@extends('layouts.app')
@section('content')
    <div class="container p-3">
        <div class="row">
            <div class="col col-12 col-xl-6 border p-3 offset-xl-3">
                <h3 class="mb-4">Characters</h3>
                @if(count($characterNames))
                    <ul>
                        @foreach($characterNames as $character)
                            <li>{{$character}}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
@endsection
