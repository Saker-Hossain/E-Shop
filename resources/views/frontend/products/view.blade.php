@extends('layouts.front')

@section('title', $products->name)

@section('content')
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{url('/add-rating')}}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{$products->id}}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Rate {{$products->name}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="rating-css">
                            <div class="star-icon">
                                <input type="radio" value="1" name="product_rating" checked id="rating1">
                                <label for="rating1" class="fa fa-star"></label>
                                <input type="radio" value="2" name="product_rating" id="rating2">
                                <label for="rating2" class="fa fa-star"></label>
                                <input type="radio" value="3" name="product_rating" id="rating3">
                                <label for="rating3" class="fa fa-star"></label>
                                <input type="radio" value="4" name="product_rating" id="rating4">
                                <label for="rating4" class="fa fa-star"></label>
                                <input type="radio" value="5" name="product_rating" id="rating5">
                                <label for="rating5" class="fa fa-star"></label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container">
            <h6 class="mb-0">
                <a href="{{ url('category') }}">
                    Collections
                </a> /
                <a href="{{ url('view-category/' . $products->category->slug) }}">
                    {{ $products->category->name }}
                </a> /
                <a href="{{ url('category/' . $products->category->slug . '/' . $products->slug) }}">
                    {{ $products->name }}
                </a>
            </h6>
        </div>
    </div>
    <div class="container">
        <div class="card shadow product_data">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 border-right">
                        <img src="{{ asset('storage' . '/' . $products->image) }}" class="w-100" alt="">
                    </div>
                    <div class="col-md-8">
                        <h2 class="mb-0">
                            {{ $products->name }}
                            <label style="font-size 16px;"
                                class="float-end badge bg-danger trending_tag">{{ $products->trending == '1' ? 'Trending' : '' }}</label>
                        </h2>

                        <hr>
                        <label class="me-3">Original Price : <s> {{ $products->original_price }}
                                Taka</s></label>
                        <label class="fw-bold">Selling Price : {{ $products->selling_price }} Taka</label>

                            @php $ratenum = ceil($rating_value) @endphp

                        <div class="rating">
                            @for ($i =1; $i<= $ratenum; $i++)
                                <i class="fa fa-star checked"></i>
                            @endfor
                            @for($j = $ratenum+1; $j <= 5; $j++)
                                <i class="fa fa-star"></i>
                            @endfor
                            <span>
                                @if ($ratings->count() > 0)
                                    {{$ratings->count()}} Ratings
                                @else
                                No Ratings
                                @endif
                            </span>
                        </div>

                        <p class="mt-3">
                            {!! $products->small_description !!}
                        </p>
                        <hr>
                        @if ($products->qty > 0)
                            <label class="badge bg-success">In stock</label>
                        @else
                            <label class="badge bg-danger">Out of stock</label>
                        @endif
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <div class="row">

                                    <div class="col-12">
                                        <div class="d-flex align-items-end">
                                            <div>
                                                <input type="hidden" value="{{ $products->id }}" class="prod_id">
                                                <label for="Quantity">Quantity</label>
                                                <div class="input-group text-center" style="width:130px">
                                                    <button class="input-group-text decrement-btn">-</button>
                                                    <input type="text" name="quantity" value="1"
                                                        class="form-control text-center qty-input" />
                                                    <button class="input-group-text increment-btn">+</button>
                                                </div>
                                            </div>
                                            <div class="ms-3">
                                                @if ($products->qty > 0)
                                                    <button style="width: max-content" type="button"
                                                        class="btn btn-primary me-3 addToCartBtn float-start">Add to Cart <i
                                                            class="fa fa-shopping-cart"></i> </button>
                                                @endif
                                                <div class="d-flex">
                                                    <button style="width: max-content" type="button"
                                                        class="btn btn-success me-3 addToWishlist float-start">Add to
                                                        Wishlist <i class="fa fa-heart"></i> </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <hr>
                    <h3>Description</h3>
                    <p class="mt-3">
                        {!! $products->description !!}
                    </p>

                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Rate this product
                    </button>

                </div>

            </div>
        </div>
    </div>
@endsection
