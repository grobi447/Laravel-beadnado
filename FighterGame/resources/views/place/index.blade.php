@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="w-max">
                <div class="card">
                    <div class="card-header ">
                        <h2>Places</h2>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="container">
                            <div class="row ">
                                @foreach ($places as $place)
                                    <div class="col-md-6">
                                        <!-- Ide jön a karakter specifikus tartalom -->
                                        <div class="card">
                                            <div class="card-header text-center">
                                                {{ $place->name }}
                                            </div>
                                            <div class="card-body text-center">
                                                <div class="container">
                                                    @if (Storage::disk('public')->exists('images/' . $place->imagename))
                                                        <img src="{{ asset('storage/images/' . $place->imagename) }}" class="img-fluid">
                                                    @else
                                                        <img src="{{ asset('images/' . $place->imagename) }}" class="img-fluid">
                                                    @endif
                                                </div>
                                            </div>
                                            <a href="{{Route('places.edit', ['id' => $place->id])}}">Edit place</a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
