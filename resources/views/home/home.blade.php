@extends('layouts.main')

@section('source')
    <div class=" container-fluid">
        <div class="my-3 col-7 offset-4 row">
            <div class="col-3 ">
                <form action="{{ route('pokemon#home') }}" method="get">
                    <div class="d-flex">
                        @csrf
                        <input type="text" name="searchKey" class="form-control" placeholder="Search name...">
                        <button class="btn btn-outline-dark" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
            <div class="col-2">
                <select class="form-select" aria-label="Default select example" id="sortingOption" name="sorting">
                    <option selected value=" ">Price</option>
                    <option value="high">Highest to lowest</option>
                    <option value="low">Lowest to highest</option>
                </select>
            </div>
            <div class="col-2">
                <a class=" form-control dropdown-toggle text-decoration-none" href="#" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    Rarity level
                </a>
                <ul class="dropdown-menu">
                    <li><a href="{{ route('pokemon#home') }}" class="text-decoration-none text-dark">All</a> </li>
                    @foreach ($rarity as $r)
                        <li><a href="{{ route('pokemon#filter', $r->id) }}"
                                class="text-decoration-none text-dark ms-2">{{ $r->name }}</a></li>
                    @endforeach

                </ul>
            </div>
        </div>
        @if (count($post) != 0)
            <div class="ms-5 row" id="dataList">
                @foreach ($post as $p)
                    <div class="col" id="myData">
                        <div class="m-5 card col-4" style="width: 20rem;">
                            <img src=" {{ asset('storage/' . $p->image) }} " style="height: 300px;" alt="...">
                            <div class="my-2 card-body">
                                <h4 class="mb-2 text-center card-title">{{ $p->name }}</h4>
                                <p class="my-2 text-center"><strong class="text-info">{{ $p->rarity_name }}</strong></p>
                                <div class="mb-2 d-flex justify-content-center">
                                    <p class="card-text me-3">{{ $p->price }} $</p>
                                    <p class="card-text ms-3">{{ $p->qty }} left</p>
                                </div>
                                <div class="text-center">
                                    <button class="text-center btn btn-lg btn-warning">Selected</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <h2 class="p-3 mt-5 text-center rounded bg-danger">There is no data about Pokemon!</h2>
            <p class="p-3 mt-5 text-center rounded bg-info">Firstly, click create rarity button and create rarity level. And
                click create pokemon button and create pokemon.
            </p>
        @endif
    </div>
@endsection

@section('myScript')
    <script>
        $(document).ready(function() {
            $('#sortingOption').change(function() {
                $sortingOption = $('#sortingOption').val();
                console.log($sortingOption);
                if ($sortingOption == 'high') {
                    $.ajax({
                        type: 'get',
                        url: "pokemon/list",
                        data: {
                            'status': 'high'
                        },
                        dataType: 'json',
                        success: function(response) {
                            $list = '';
                            for ($i = 0; $i < response.length; $i++) {
                                $list += `
                            <div class="col" id="myData">
                            <div class="m-5 card col-4" style="width: 20rem;">
                                <img src=" {{ asset('storage/${response[$i].image}') }} " style="height: 300px;"  alt="...">
                                <div class="my-2 card-body">
                                  <h4 class="mb-2 text-center card-title">${response[$i].name}</h4>
                                  <div class="mb-2 d-flex justify-content-center">
                                    <p class="card-text me-3">${response[$i].price} $</p>
                                    <p class="card-text ms-3">${response[$i].qty} left</p>
                                  </div>
                                  <div class="text-center">
                                    <button class="text-center btn btn-lg btn-warning">Selected</button>
                                </div>
                                </div>
                              </div>
                            </div>
                            `;
                            }
                            $('#dataList').html($list);
                        }
                    })
                } else if ($sortingOption == 'low') {
                    $.ajax({
                        type: 'get',
                        url: "pokemon/list",
                        data: {
                            'status': 'low'
                        },
                        dataType: 'json',
                        success: function(response) {
                            $list = '';
                            for ($i = 0; $i < response.length; $i++) {
                                $list += `
                            <div class="col" id="myData">
                            <div class="m-5 card col-4" style="width: 20rem;">
                                <img src=" {{ asset('storage/${response[$i].image}') }} " style="height: 300px;"  alt="...">
                                <div class="my-2 card-body">
                                  <h4 class="mb-2 text-center card-title">${response[$i].name}</h4>
                                  <div class="mb-2 d-flex justify-content-center">
                                    <p class="card-text me-3">${response[$i].price} $</p>
                                    <p class="card-text ms-3">${response[$i].qty} left</p>
                                  </div>
                                  <div class="text-center">
                                    <button class="text-center btn btn-lg btn-warning">Selected</button>
                                </div>
                                </div>
                              </div>
                            </div>
                            `;
                            }
                            $('#dataList').html($list);
                        }
                    })
                }
            })
        });
    </script>
@endsection
