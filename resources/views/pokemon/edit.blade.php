@extends('layouts.main')


@section('source')
    <form action="{{ route('pokemon#update', $pokemon->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="p-2 mt-5 bg-opacity-50 border rounded row col-8 offset-2 border-light-subtle bg-body-tertiary" border>

            <div class=" row">
                <h4 class="text-center text-dark">Edit Pokemon Page</h4>
                <hr>
                <div class="">
                    <a href="{{ route('pokemon#createPage') }}" class="m-1 text-dark text-decoration-none"><i
                            class=" fs-5 fa-solid fa-arrow-left"></i></a>
                </div>
            </div>
            <div class="mt-3 col-4 ms-4">

                <img src="{{ asset('storage/' . $pokemon->image) }}" style="width: 250px; height: 150px"
                    class="img-thumbnail " alt="">

                <input type="file" style="width: 250px" name="image"
                    class="form-control @error('image') is-invalid @enderror my-2">
                @error('image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                <button style="width: 250px" class="text-white btn btn-dark">Update</button>
            </div>
            <div class="mt-3 col-6 offset-1">
                <div class="mb-3">
                    <label for="" class="text-dark">Name</label>
                    <input type="text" name="name" value="{{ old('name', $pokemon->name) }}"
                        class="form-control @error('name') is-invalid @enderror">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="" class="text-dark">Rarity</label>
                    <select name="rarity" class="form-control @error('rarity') is-invalid @enderror" id="">
                        <option value="">Choose Category</option>
                        @foreach ($rarity as $r)
                            <option value="{{ $r->id }}" @if ($pokemon->rarity == $r->id) selected @endif>
                                {{ $r->name }}</option>
                        @endforeach

                    </select>
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="" class="text-dark">Price</label>
                    <input name="price" type="number" class="form-control @error('price') is-invalid @enderror"
                        id="" value="{{ old('price', $pokemon->price) }}"></input>
                    @error('price')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="" class="text-dark">Quantity</label>
                    <input type="number" name="qty" value="{{ old('qty', $pokemon->qty) }}"
                        class="form-control @error('qty') is-invalid @enderror">
                    @error('qty')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

        </div>
    @endsection
