@extends('layouts.app')
@section('content')
    <div class="container p-3">
        <div class="row">
            <div class="col col-12 col-xl-6 border p-3 offset-xl-3">
                <h3 class="mb-4">Species that are {{$type}}</h3>
                @if(count($species))
                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <th>Name</th>
                            <th>Home World</th>
                        </thead>
                        @foreach($species as $name => $homeworld)
                            <tr>
                                <td>{{$name}} </td>
                                <td>{{$homeworld}}</td>
                            </tr>
                        @endforeach
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection
