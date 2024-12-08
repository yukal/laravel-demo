@extends('layout')
@section('title', 'New Movie')

@section('menu')
    <div class="collapse navbar-collapse" id="navbarContent">
        @include('movies.menu')
        <button type="button" class="btn btn-primary btn-sm" onclick="history.back()"><i class="fa fa-arrow-left"></i> Back</button>
    </div>
@endsection

@section('content')
    <form action="{{ route('movies.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group mb-3">
            <label for="inputName" class="form-label"><strong>Name:</strong></label>
            <input type="text" id="inputName" placeholder="Name" name="name" value="{{ old('name', '') }}"
                class="form-control @error('name') is-invalid @enderror">
            @error('name')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="inputImage" class="form-label"><strong>Poster:</strong></label>
            <input type="file" id="inputImage" name="image" class="form-control @error('image') is-invalid @enderror">
            @error('image')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label class="form-label @error('genres') is-invalid @enderror">
                <strong>Genres:</strong>
            </label>

            <div class="d-flex flex-row flex-wrap justify-content-start align-items-start @error('genres') is-invalid @enderror" role="group" aria-label="Genres">
                @foreach ($genres as $genre)
                    <input type="checkbox" class="btn-check" id="btn-genre-{{ $loop->iteration }}"
                        name="genres[]" value="{{ $genre->id }}" autocomplete="off"
                        @if (isset($mappedGenres[$genre->id])) checked @endif>
                    <label class="btn btn-outline-primary btn-sm me-1 mb-1"
                        for="btn-genre-{{ $loop->iteration }}">{{ $genre->name }}</label>
                @endforeach
            </div>

            @error('genres')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
    </form>
@endsection
