@extends('movies.layout')
@section('content')

<div class="card mt-5">
    <h2 class="card-header">Add New Movie</h2>
    <div class="card-body">

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a class="btn btn-primary btn-sm" href="{{ route('movies.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
        </div>

        <form action="{{ route('movies.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="inputName" class="form-label"><strong>Name:</strong></label>
                <input type="text" id="inputName" placeholder="Name"
                    name="name" 
                    class="form-control @error('name') is-invalid @enderror">
                @error('name')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="inputImage" class="form-label"><strong>Image:</strong></label>
                <input type="file" id="inputImage" name="image"
                    class="form-control @error('image') is-invalid @enderror">
                @error('image')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="inputGenre" class="form-label @error('genre') is-invalid @enderror">
                    <strong>Genre:</strong>
                </label>

                <br>

                <div class="btn-group @error('genre') is-invalid @enderror" role="group" aria-label="Genres">
                @foreach($genres as $genre)
                    <input type="checkbox" class="btn-check" id="btn-genre-{{$loop->iteration}}" name="genres[]" value="{{ $genre->id }}" autocomplete="off">
                    <label class="btn btn-outline-primary" for="btn-genre-{{$loop->iteration}}">{{ $genre->name }}</label>
                @endforeach
                </div>

                @error('genres')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
        </form>

    </div>
</div>
@endsection