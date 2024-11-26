@extends('movies.layout')
@section('content')
@php
    $movieGenres = $movie->genres;
    $mappedGenres = $movie->mappedGenres($movieGenres);
@endphp

<div class="card mt-5">
    <h2 class="card-header">Edit Movie</h2>
    <div class="card-body">

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a class="btn btn-primary btn-sm" href="{{ route('movies.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
        </div>

        <div class="d-flex flex-row flex-wrap justify-content-between mb-3">
            <div class="p-2">
                <img src="{{ asset('storage/'.$movie->link) }}" class="rounded" width="300">
            </div>

            <div class="p-2 flex-grow-1">
                <form action="{{ route('movies.update', $movie->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>ID:</strong> {{ $movie->id }}
                        </div>

                        <div class="form-group">
                            <strong>Status:</strong> {{ $movie->status }}
                        </div>

                        <div class="form-group mt-3">
                            <label for="inputName" class="form-label"><strong>Name:</strong></label>
                            <input type="text" name="name" id="inputName" placeholder="Name"
                                value="{{ old('name', $movie->name) }}"
                                class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <label class="form-label @error('genre') is-invalid @enderror">
                                <strong>Genres:</strong>
                            </label>

                            <div class="d-flex flex-row flex-wrap justify-content-start align-items-start @error('genre') is-invalid @enderror" role="group" aria-label="Genres">
                            @foreach($genres as $genre)
                                <input type="checkbox" class="btn-check" id="btn-genre-{{$loop->iteration}}" name="genres[]" value="{{ $genre->id }}" autocomplete="off"
                                @if(isset($mappedGenres[$genre->id])) checked @endif>
                                <label class="btn btn-outline-primary" for="btn-genre-{{$loop->iteration}}">{{ $genre->name }}</label>
                            @endforeach
                            </div>

                            @error('genres')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success mt-5">
                            <i class="fa-solid fa-floppy-disk"></i> Update
                        </button>
                    </div>
                </div>

                </form>
            </div>
        </div>

    </div>
</div>
@endsection
