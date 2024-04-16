@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="w-max">
                <div class="card">
                    <div class="card-header ">
                        <h2>My Characters</h2>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="container">
                            <div class="row ">
                                @foreach($characters as $character)
                                <div class="col-md-6">
                                    <!-- Ide jön a karakter specifikus tartalom -->
                                    <div class="card">
                                        <div class="card-header text-center">
                                            {{ $character->name }}
                                        </div>
                                        <div class="card-body text-center">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        Defence: {{$character->defence}}
                                                    </div>
                                                    <div class="col-md-6">
                                                        Strength: {{$character->strength}}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        Accuracy: {{$character->accuracy}}
                                                    </div>
                                                    <div class="col-md-6">
                                                        Magic: {{$character->magic}}
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="{{ route('characters.show', $character->id) }}" class="button">Character details</a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                </div>
            </div>
        </div>
    @endsection
