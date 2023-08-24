@extends('user.main')

@section('content')
<style>
    a {
        text-decoration: none;
    }
</style>


    <form action="{{ route('user.search') }}" method="GET" class="form-inline">
        <div class="input-group">
            <input type="text" name="query" class="form-control" placeholder="Search...">
            <div class="input-group-append">
                <button type="submit" class="btn btn-info">Search</button>
            </div>
        </div>
    </form>

    <h2 class="text-center my-3">Products List</h2>

    <div class="row">
        @foreach ($products as $product)
        <div class="col-md-4 mb-4">
            <div class="card py-3">
                <div id="carousel-{{ $product->id }}" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        @if ($product->images->isEmpty())
                            <div class="carousel-item active">
                                <img src="{{ asset('storage/product-images/empty-image.png') }}" alt="Empty Image" class="d-block w-100 img-carousel">
                            </div>
                        @else
                        @foreach ($product->images as $index => $image)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                <img src="{{ asset('storage/product-images/' . $image->url) }}" alt="{{ $product->name . ' image' }}" class="d-block w-100 img-carousel">
                            </div>
                            @endforeach
                        @endif
                    </div>
                    <a class="carousel-control-prev" href="#carousel-{{ $product->id }}" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carousel-{{ $product->id }}" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>

                <div class="card-body flex-grow-1">

                    <h5 class="card-title"><a href="{{ route('user.product', $product->id) }}">{{ \Illuminate\Support\Str::limit($product->name, 50, $end = '...') }}</a></h5>
                    <p class="card-text">Rp {{ number_format($product->price, 0, ',', '.')  }}</p>
                    
                    
                    <a href="{{ route('user.product', $product->id) }}" class="btn btn-primary">Order</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <style>
        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            color: black;
        }
        
        .img-carousel {
            max-height: 150px;
            object-fit: contain;
        }
    </style>

    <script>
        // Initialize the carousels
        $('.carousel').carousel();
    </script>
    
@endsection
