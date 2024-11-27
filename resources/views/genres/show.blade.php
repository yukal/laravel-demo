@extends('layout')
@section('title', 'Genre: ' . $genre->name)

@section('menu')
    <div class="collapse navbar-collapse" id="navbarContent">
        @include('genres.menu')
        <a class="btn btn-success btn-sm me-1" href="{{ route('genres.create') }}"><i class="fa fa-plus"></i> New Genre</a>
        <button type="button" class="btn btn-primary btn-sm" onclick="history.back()"><i class="fa fa-arrow-left"></i> Back</button>
    </div>
@endsection

@section('content')
    <strong>Genres:</strong>

    <table class="table table-bordered table-striped mt-2 mb-0">
        <thead>
            <tr>
                <th width="80px">No</th>
                <th>Name</th>
                <th width="250px">Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($genre->movies as $movie)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><a href="{{ route('movies.show', $movie->id) }}">{{ $movie->name }}</a></td>
                    <td>
                        <form action="{{ route('genres.destroy', $genre->id) }}" method="POST">
                            <a class="btn btn-primary btn-sm" href="{{ route('movies.edit', $movie->id) }}"><i
                                    class="fa-solid fa-pen-to-square"></i> Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i>
                                Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">There are no data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
