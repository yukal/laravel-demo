@extends('movies.layout')
@section('content')

<div class="card mt-5">
    <h2 class="card-header">Movies</h2>
    <div class="card-body">

        @if(session('success'))
            <div class="alert alert-success" role="alert">{{ session('success') }}</div>
        @endif

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a class="btn btn-success btn-sm" href="{{ route('movies.create') }}"><i class="fa fa-plus"></i> Create New Movie</a>
        </div>

        <table class="table table-bordered table-striped mt-4">
            <thead>
                <tr>
                    <th width="80px">No</th>
                    <th>Name</th>
                    <th width="250px">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($movies as $movie)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $movie->name }}</td>
                        <td>
                            <form action="{{ route('movies.destroy',$movie->id) }}" method="POST">
                                <a class="btn btn-info btn-sm" href="{{ route('movies.show',$movie->id) }}"><i class="fa-solid fa-list"></i> Show</a>
                                <a class="btn btn-primary btn-sm" href="{{ route('movies.edit',$movie->id) }}"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i> Delete</button>
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

    </div>
</div>  

@endsection