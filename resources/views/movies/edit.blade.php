@extends('layout')
@section('title', 'Edit Movie')

@section('menu')
    <div class="collapse navbar-collapse" id="navbarContent">
        @include('movies.menu')
        <button type="button" class="btn btn-primary btn-sm" onclick="history.back()"><i class="fa fa-arrow-left"></i> Back</button>
    </div>
@endsection

@section('content')
    @php
        $publicPath = public_path('storage/');

        $movieGenres = $movie->genres;
        $mappedGenres = $movie->mappedGenres($movieGenres);
    @endphp

    <div class="d-flex flex-row flex-wrap justify-content-between">
        <div class="p-2">
            @if ($movie->existImage)
                <img class="rounded" width="300" src="{{ asset('storage/' . $movie->link) }}">
            @else
                <img class="rounded" width="300" src="{{ asset('storage/no-image-placeholder.svg') }}">
            @endif
        </div>

        <div class="p-2 flex-grow-1">
            <form action="{{ route('movies.update', $movie->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>ID:</strong> {{ $movie->id }}
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
                            <label for="inputImage" class="form-label"><strong>Image:</strong></label>
                            <input type="file" id="inputImage" name="image"
                                class="form-control @error('image') is-invalid @enderror">
                            @error('image')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-3 col-sm-6 col-md-4">
                            <div class="form-floating">
                                <select class="form-select @error('status') is-invalid @enderror" id="inputStatus" name="status" aria-label="status">
                                    @foreach($statuses as $value => $label)
                                        <option value="{{ $value }}" {{ $movie->status === $label ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                                <label for="inputStatus">Status</label>
                            </div>

                            @error('status')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <label class="form-label @error('genre') is-invalid @enderror">
                                <strong>Genres:</strong>
                            </label>

                            <div class="d-flex flex-row flex-wrap justify-content-start align-items-start @error('genre') is-invalid @enderror"
                                role="group" aria-label="Genres">
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

                        <button type="submit" class="btn btn-success mt-5">
                            <i class="fa-solid fa-floppy-disk"></i> Update
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
