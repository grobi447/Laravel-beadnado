@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 ">
            <div class="card">
                <div class="card-header text-center">
                    {{ $character->name }}
                </div>
                <div class="card-body text-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                Defence: {{ $character->defence }}
                            </div>
                            <div class="col-md-6">
                                Strength: {{ $character->strength }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                Accuracy: {{ $character->accuracy }}
                            </div>
                            <div class="col-md-6">
                                Magic: {{ $character->magic }}
                            </div>
                        </div>
                    </div>
                    <h3>Meccsek:</h3>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Place name</th>
                                <th>Enemy</th>
                                <th>Match</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($PlaceNames as $index => $placeName)
                                    <tr>
                                        <td>{{ $placeName }}</td>
                                        <td>{{ $OpponentNames[$index] }}</td>
                                        <td> <a href="{{Route('matches.show', ['id' => $character->id]) }}">match details</a></td>
                                    </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <a href="{{Route('matches.create', ['id' => $character->id]) }}">New Match</a>
                <a href="{{Route('characters.edit', ['id' => $character->id])}}">Edit Character</a>
                <a href="{{Route('characters.delete', ['id' => $character->id])}}">Delete Character</a>
            </div>
        </div>
    </div>
@endsection
