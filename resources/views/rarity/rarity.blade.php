@extends('layouts.main')

@section('source')
    <div class="">
        <div class="col-5 offset-4">
            <div class="p-2 mt-5 border rounded border-light-subtle bg-body-tertiary">
                @if (session('CreateSuccess'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-circle-check me-2"></i>{{ session('CreateSuccess') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="">
                    <h4 class="text-center my-2">Create rarity level</h4>
                </div>
                <form action="{{ route('rarity#create') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mt-1 ">
                        <div class="">
                            <label for="" class="my-3 text-dark">Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                placeholder="Enter name...">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="my-3 offset-10">
                            <button class="text-white btn btn-dark " type="submit">Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
