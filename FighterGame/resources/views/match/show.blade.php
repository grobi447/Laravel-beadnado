@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header text-center">
                {{ $place->name }}
            </div>
            <div class="card-body text-center">
                <div class="container">
                    @if (Storage::disk('public')->exists('images/' . $place->imagename))
                        <div style="background-image: url('{{ asset('storage/images/' . $place->imagename) }}'); height: 400px;background-size: cover; background-position: center;"
                            class="img-fluid" >
                            @include('match.data')
                        </div>
                    @else
                        <div style="background-image: url('{{ asset('images/' . $place->imagename) }}'); height: 400px; background-size: cover; background-position: center;"
                            class="img-fluid">
                            @include('match.data')
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
