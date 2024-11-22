@extends('genres.layout')
@section('content')

<div class="card mt-5">
    <h2 class="card-header">Genre: {{ $genre->name }}</h2>
    <div class="card-body">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a class="btn btn-primary btn-sm" href="{{ route('genres.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                <strong>genres:</strong>

                <table class="table table-bordered table-striped mt-4">
                    <thead>
                        <tr>
                            <th width="80px">No</th>
                            <th>Name</th>
                            <th width="250px">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($genre->movies as $genre)
                            @if($genre->status == 0)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><a href="{{ $genre->link }}">{{ $genre->name }}</a></td>
                                <td>
                                    <form action="{{ route('genres.destroy',$genre->id) }}" method="POST">
                                        <a class="btn btn-info btn-sm" href="{{ route('genres.show', $genre->id) }}"><i class="fa-solid fa-list"></i> Show</a>
                                        <a class="btn btn-primary btn-sm" href="{{ route('genres.edit', $genre->id) }}"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endif
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