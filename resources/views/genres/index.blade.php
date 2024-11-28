@extends('layout')
@section('title', 'Genres')

@section('menu')
    <div class="collapse navbar-collapse" id="navbarContent">
        @include('genres.menu')
        <a class="btn btn-success btn-sm" href="{{ route('genres.create') }}"><i class="fa fa-plus"></i> New Genre</a>
    </div>
@endsection

@section('content')
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th width="80px">No</th>
                <th>Name</th>
                <th width="250px">Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($genres as $genre)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td><a href="{{ route('genres.show', $genre->id) }}">{{ $genre->name }}</a></td>
                    <td>
                        <form action="{{ route('genres.destroy', $genre->id) }}" method="POST">
                            <a class="btn btn-primary btn-sm" href="{{ route('genres.edit', $genre->id) }}"><i
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

    {{ $genres->links() }}
@endsection
