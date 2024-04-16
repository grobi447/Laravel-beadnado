@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit {{ $character->name }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('characters.update', $character) }}" novalidate
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name', $character->name) }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            @if (Auth::user()->admin)
                                <div class="row mb-3">
                                    <label for="enemy"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Enemy') }}</label>

                                    <div class="col-md-6">
                                        <input id="name" type="checkbox" name="enemy"
                                            @if ($character->enemy) checked @endif
                                            value="{{ $character->enemy }}">

                                        @error('enemy')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            @else
                                <input type="hidden" name="enemy" value="{{ $character->enemy }}">
                            @endif

                            <div class="row mb-3">
                                <label for="defence"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Defence') }}</label>

                                <div class="col-md-6">
                                    <input id="defence " type="number"
                                        class="form-control @error('defence') is-invalid @enderror" name="defence"
                                        value="{{ old('defence', $character->defence) }}">

                                    @error('defence')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="strength"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Strength ') }}</label>

                                <div class="col-md-6">
                                    <input id="strength" type="number"
                                        class="form-control @error('strength') is-invalid @enderror" name="strength"
                                        value="{{ old('strength', $character->strength) }}">

                                    @error('strength')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="accuracy"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Accuracy ') }}</label>

                                <div class="col-md-6">
                                    <input id="accuracy" type="number"
                                        class="form-control @error('accuracy') is-invalid @enderror" name="accuracy"
                                        value="{{ old('accuracy', $character->accuracy) }}">

                                    @error('accuracy')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="magic"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Magic') }}</label>

                                <div class="col-md-6">
                                    <input id="magic" type="number"
                                        class="form-control @error('magic') is-invalid @enderror" name="magic"
                                        value="{{ old('magic', $character->magic) }}">

                                    @error('magic')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
