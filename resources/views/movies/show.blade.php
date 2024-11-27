@extends('movies.layout')
@section('content')
@php
    $publicPath = public_path('storage/');
@endphp


<div class="card mt-5">
    <h2 class="card-header">Show Movie</h2>
    <div class="card-body">

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a class="btn btn-primary btn-sm" href="{{ route('movies.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
        </div>

        <div class="d-flex flex-row flex-wrap justify-content-between mb-3">
            <div class="p-2">
                @if ($movie->existImage)
                    <img class="rounded" width="300" src="{{ asset('storage/'.$movie->link) }}">
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
                            <strong>Link:</strong> {{ $movie->link }}
                        </div> -->
                        <div class="form-group">
                            <strong>Status:</strong> {{ $movie->status }}
                        </div>
                        <div class="form-group">
                            <strong>Genres:</strong> {{ $movie->genresNames }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
