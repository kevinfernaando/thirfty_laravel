@extends('admin.main')

@section('content')

    <form action="{{ route('admin.search') }}" method="GET" class="form-inline">
        <div class="input-group">
            <input type="text" name="query" class="form-control" placeholder="Search...">
            <div class="input-group-append">
                <button type="submit" class="btn btn-info">Search</button>
            </div>
        </div>
    </form>

    <h2 class="text-center">Products List</h2>

    <div class="text-center m-3">
        <a href="{{ route('admin.create_product_form') }}" class="btn btn-primary">Add New Product</a>
    </div>

    <div class="row">
        @foreach ($products as $product)
        <div class="col-md-4 mb-4">
            <div class="card">
                <div id="carousel-{{ $product->id }}" class="carousel slide my-2" data-ride="carousel">
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

                <div class="card-body">
                    <h5 class="card-title">{{ \Illuminate\Support\Str::limit($product->name, 50, $end = '...') }}</h5>
                    <p class="card-text">Rp {{ number_format($product->price, 0, ',', '.')  }}</p>
                    
                    <form action="{{ route('admin.delete_product', $product->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                    </form>

                    <a href="{{ route('admin.edit_form', $product->id) }}" class="btn btn-secondary">Update</a>
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
        $('.carousel').carousel();
    </script>
    
@endsection
