@extends('layout')
@section('title', 'Movies')

@section('menu')
    <div class="collapse navbar-collapse" id="navbarContent">
        @include('movies.menu')
        <a class="btn btn-success btn-sm" href="{{ route('movies.create') }}"><i class="fa fa-plus"></i> New Movie</a>
    </div>
@endsection

@section('content')
    <table class="table table-bordered table-striped mb-0">
        <thead>
            <tr>
                <th width="80px">No</th>
                <th>Name</th>
                <th>Status</th>
                <th width="250px">Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($movies as $movie)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td><a href="{{ route('movies.show', $movie->id) }}">{{ $movie->name }}</a></td>
                    <td>{{ $movie->status }}</td>
                    <td>
                        <form action="{{ route('movies.destroy', $movie->id) }}" method="POST">
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
