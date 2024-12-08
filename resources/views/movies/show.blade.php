@extends('layout')
@section('title', 'Movie: ' . $movie->name)

@section('menu')
    <div class="collapse navbar-collapse" id="navbarContent">
        @include('movies.menu')

        <a class="btn btn-success btn-sm me-1" href="{{ route('movies.create') }}"><i class="fa fa-plus"></i> New Movie</a>
        <button type="button" class="btn btn-primary btn-sm" onclick="history.back()"><i class="fa fa-arrow-left"></i> Back</button>
    </div>
@endsection

@section('content')
    <div class="d-flex flex-row flex-wrap justify-content-between">
        <div class="p-2">
            @if ($movie->existImage)
                <img class="rounded" width="300" src="{{ asset('storage/' . $movie->poster) }}">
            @else
                <img class="rounded" width="300" src="{{ asset('storage/no-image-placeholder.svg') }}">
            @endif
        </div>

        <div class="p-2 flex-grow-1">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group mt-3">
                        <strong>ID:</strong> {{ $movie->id }}
                    </div>
                    <div class="form-group">
                        <strong>Name:</strong> {{ $movie->name }}
                    </div>
                    <!-- <div class="form-group">
                        <strong>Poster:</strong> {{ $movie->poster }}
                    </div> -->
                    <div class="form-group">
                        <strong>Status:</strong> {{ $movie->status_text }}
                    </div>
                    <div class="form-group">
                        <strong>Genres:</strong> {{ implode(', ', $movie->genres_names) }}
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
