@extends('layout')
@section('title', 'Movies')

@section('menu')
    <div class="collapse navbar-collapse" id="navbarContent">
        @include('movies.menu')
        <a class="btn btn-success btn-sm me-1" href="{{ route('movies.create') }}"><i class="fa fa-plus"></i> New Movie</a>

        @if ($isShowUnpublished)
            <a class="btn btn-primary btn-sm" href="{{ route('movies.index') }}">
                <i class="fa fa-eye"></i> Unpublished</a>
        @else
            <a class="btn btn-outline-primary btn-sm" href="{{ route('movies.unpublished') }}">
                <i class="fa fa-eye"></i> Unpublished</a>
        @endif
    </div>
@endsection

@section('content')
    <table class="table table-bordered table-striped">
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
                    <td>{{ $movie->status_text }}</td>
                    <td>
                        <div class="btn-group btn-group-sm" role="group" aria-label="Action">
                            @if (!$movie->is_published)
                            <button type="button" class="btn btn-outline-primary" onclick="submitPublish({{ $movie->id }})">
                                <i class="fa-solid fa-eye"></i> Publish</button>
                            @endif

                            <a class="btn btn-outline-primary" href="{{ route('movies.edit', $movie->id) }}"><i class="fa-solid fa-pen-to-square"></i> Edit</a>

                            <button type="button" class="btn btn-outline-danger" onclick="submitDestroy({{ $movie->id }})">
                                <i class="fa-solid fa-trash"></i> Delete</button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">There are no data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $movies->links() }}

    <form name="form-publish" method="POST">
        @csrf
        @method('PATCH')
        <input type="hidden" name="is_published" value="1" />
    </form>

    <form name="form-destroy" method="POST">
        @csrf
        @method('DELETE')
    </form>

    <script>
        function submitPublish(movieID) {
            var form = document.forms['form-publish'];
            form.action = `{{ route('movies.publish', '__movieID__') }}`
                .replace('__movieID__', movieID);

            form.submit();
        }

        function submitDestroy(movieID) {
            var form = document.forms['form-destroy'];
            form.action = `{{ route('movies.destroy', '__movieID__') }}`
                .replace('__movieID__', movieID);

            form.submit();
        }
    </script>
@endsection
