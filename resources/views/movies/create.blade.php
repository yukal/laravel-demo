@extends('movies.layout')
@section('content')

<div class="card mt-5">
    <h2 class="card-header">Add New Movie</h2>
    <div class="card-body">

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a class="btn btn-primary btn-sm" href="{{ route('movies.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
        </div>

        <form action="{{ route('movies.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="inputName" class="form-label"><strong>Name:</strong></label>
                <input type="text" id="inputName" placeholder="Name"
                    name="name" 
                    class="form-control @error('name') is-invalid @enderror">
                @error('name')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="inputLink" class="form-label"><strong>Link:</strong></label>
                <input type="text" id="inputLink" placeholder="Link"
                    name="link" 
                    class="form-control @error('link') is-invalid @enderror">
                @error('link')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="inputStatus" class="form-label">
                    <strong>Status:</strong>
                </label>

                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="status" id="inputStatus"
                        class="form-control @error('status') is-invalid @enderror" />
                    <label class="form-check-label" for="inputStatus">show</label>
                </div>

                @error('status')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>

            <br>
            <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
        </form>

    </div>
</div>
@endsection