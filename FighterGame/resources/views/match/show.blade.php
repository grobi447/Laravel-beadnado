@extends('layouts.app')
@php
    $json = json_decode($match->history, true);
@endphp
@section('content')
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header text-center">
                {{ $place->name }}
            </div>
            <div class="card-body text-center">
                @if($match->win === null)
                <div class="row">
                    <div class="col text-center">
                        <a href="{{ route('matches.attack', ['id' => $match->id, 'action' => 'melee']) }}">Melee</a>
                    </div>
                    <div class="col text-center">
                        <a href="{{ route('matches.attack', ['id' => $match->id, 'action' => 'ranged']) }}">Ranged</a>
                    </div>
                    <div class="col text-center">
                        <a href="{{ route('matches.attack', ['id' => $match->id, 'action' => 'special']) }}">Special</a>
                    </div>
                </div>
                    @endif
                <div class="container">
                    @if (Storage::disk('public')->exists('images/' . $place->imagename))
                        <div style="background-image: url('{{ asset('storage/images/' . $place->imagename) }}'); height: 400px;background-size: cover; background-position: center;"
                            class="img-fluid">
                            @include('match.data')
                        </div>
                    @else
                        <div style="background-image: url('{{ asset('images/' . $place->imagename) }}'); height: 400px; background-size: cover; background-position: center;"
                            class="img-fluid">
                            @include('match.data')
                        </div>
                    @endif
                </div>
                <h2>History:</h2>
                <div class="container">
                    <ul style="list-style-type: none;">
                        @foreach ($json as $historyItem)
                                    <li>{{ $historyItem['character_name']}}: {{$historyItem['action']}} attack - {{$historyItem['damage']}} damage</li>
                        @endforeach
                    </ul>
                </div>
                @if($match->win !== null)
                    <h2>Winner:</h2>
                    @if($match->win == 1)
                        <h3>{{$match->character[0]->name}}</h3>
                    @else
                        <h3>{{$match->character[1]->name}}</h3>
                    @endif
                @endif
            </div>
        </div>
    </div>
    </div>
@endsection
