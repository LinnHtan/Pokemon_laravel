@extends('layouts.main')

@section('source')
    <div class="">
        <div class="row">
            <div class="col-5">
                <div class="p-2 mt-5 border rounded border-light-subtle ms-5 bg-body-tertiary">
                    @if (session('CreateSuccess'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-circle-check me-2"></i>{{ session('CreateSuccess') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <form action="{{ route('pokemon#create') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mt-1 ">
                            <div class="">
                                <label for="" class="my-2 text-dark">Name</label>
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror" placeholder="Enter name...">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="" class="my-2 text-dark">Rarity</label>
                                <select name="rarity" class="form-control @error('rarity') is-invalid @enderror"
                                    id="">
                                    <option value="">Choose Rarity</option>
                                    @foreach ($rarity as $r)
                                        <option value="{{ $r->id }}">{{ $r->name }}</option>
                                    @endforeach

                                </select>
                                @error('rarity')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="" class="my-2 text-dark">Price</label>
                                <input type="number" name="price"
                                    class="form-control @error('price') is-invalid @enderror" placeholder="Enter price...">
                                @error('price')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="">
                                <label for="" class="my-2 text-dark">Image</label>
                                <input type="file" name="image"
                                    class="form-control @error('image') is-invalid @enderror">
                                @error('image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="">
                                <label for="" class="my-2 text-dark">Quantity</label>
                                <input type="number" name="qty" class="form-control @error('qty') is-invalid @enderror"
                                    placeholder="Enter quantity...">
                                @error('qty')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="my-2 offset-10">
                                <button class="text-white btn btn-dark " type="submit">Create</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            @if (count($pokemon) != 0)
                <div class="mt-5 border shadow-sm border-light-subtle col-6 ms-5 bg-body-tertiary"
                    style="max-height: 490px; overflow-y: auto;">
                    @if (session('deleteSuccess'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-circle-check me-2"></i>{{ session('deleteSuccess') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="p-0 card-body table-responsive">
                        <table class="table text-center table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Rarity</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pokemon as $p)
                                    <tr scoped>
                                        <td>{{ $p->id }}</td>
                                        <td>{{ $p->name }}</td>
                                        <td>
                                            <img src="{{ asset('storage/' . $p->image) }}"
                                                style="height: 70px; width: 100px; " class="align-middle img-thumbnail"
                                                alt="">
                                        </td>
                                        <td>{{ $p->price }}</td>
                                        <td>{{ $p->qty }}</td>
                                        <td>{{ $p->rarity }}</td>
                                        <td>
                                            <a href="{{ route('pokemon#edit', $p->id) }}"><button
                                                    class="text-white btn btn-sm bg-dark" title="edit"><i
                                                        class="fas fa-edit"></i></button></a>
                                            <a href="{{ route('pokemon#delete', $p->id) }}"><button
                                                    class="text-white btn btn-sm bg-danger" title="delete"><i
                                                        class="fas fa-trash-alt"></i></button></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="mt-5 col-6 ms-5 ">
                        <h2 class="p-2 text-center rounded bg-danger">No pokemon data <strong>Create Now!</strong></h2>
                    </div>
                </div>
            @endif
        </div>

    </div>
@endsection
