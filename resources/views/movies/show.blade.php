@extends('movies.layout')
@section('content')

<div class="card mt-5">
    <h2 class="card-header">Show Movie</h2>
    <div class="card-body">

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a class="btn btn-primary btn-sm" href="{{ route('movies.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>ID:</strong> {{ $movie->id }}
                </div>
                <div class="form-group">
                    <strong>Name:</strong> {{ $movie->name }}
                </div>
                <div class="form-group">
                    <strong>Link:</strong> {{ $movie->link }}
                </div>
                <div class="form-group">
                    <strong>Status:</strong> {{ $movie->status }}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                <table class="table table-bordered table-striped mt-4">
                    <thead>
                        <tr>
                            <!-- <th width="80px">№</th> -->
                            <th width="84px">Genre ID</th>
                            <th>Name</th>
                            <th width="250px">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($movie->genres as $genre)
                            <tr>
                                <!-- <td>{{ $loop->iteration }}</td> -->
                                <td>{{ $genre->pivot->genre_id }}</td>
                                <td>{{ $genre->name }}</td>
                                <td>
                                    <form action="{{ route('genres.destroy',$genre->id) }}" method="POST">
                                        <a class="btn btn-info btn-sm" href="{{ route('genres.show',$genre->id) }}"><i class="fa-solid fa-list"></i> Show</a>
                                        <a class="btn btn-primary btn-sm" href="{{ route('genres.edit',$genre->id) }}"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
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

    </div>
</div>
@endsection