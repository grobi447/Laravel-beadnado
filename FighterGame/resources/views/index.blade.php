@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header ">
                        <h1>Főoldal</h1>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <p>A játék egy egyszerűsített harcolós játék lesz, amelyben a játékos egy karaktert irányít, és
                            küzdeni fog különböző ellenfelek ellen. A harc körökre osztott lesz, ahol mind a játékos, mind
                            az ellenfél támadni és védekezni tud. A cél az ellenfél életerejének nullára csökkentése,
                            mielőtt a játékosé lenne nullára csökkentve.</p>
                            @guest
                        <p>Az eddigi mérkőzések száma: {{ $numberOfMatches }}</p>
                            @else
                            <p>Az eddigi mérkőzések száma: {{ $numberOfMatches }}</p>
                        <p>A játékban létrehozott karakterek száma: {{ $numberOfCharacters }}</p>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    @endsection
