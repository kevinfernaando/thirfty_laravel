@extends('admin.home')

@section('content')

<style>
    .content {
        display: flex;
        flex-direction: row;
    }

    .left {
        flex: 1;
        /* width: 100%; */
        max-width: 33%;
        margin-bottom: 20px; /* Add spacing between columns */
        margin-right: 50px;
    }

    .right {
        flex: 3;
        /* width: 100%; */
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        color: black !important;
    }

    .order-form{
        margin-top: 50px;
    }

    .img-carousel {
        max-width: 100%; /* Adjust image width */
        height: auto; /* Maintain aspect ratio */
        display: block; /* Fix potential spacing issues */
        margin: 0 auto; /* Center the image */
    }

    /* Add this style to adjust the carousel container size */
    .carousel {
        max-width: 100%; /* Adjust this value to your desired width */
        margin: 0 auto; /* Center the carousel horizontally */
    }

    .input-group {
        display: flex;
        flex-direction: row;
        align-items: baseline;
        justify-content: flex-start;
        margin-bottom: 20px;
    }

    /* Media query for smaller screens */
    @media (max-width: 768px) {
        .content {
            flex-direction: column;
        }

        .left,
        .right {
            width: 100%; /* Use full width for both columns */
            max-width: 100%;
            margin-bottom: 20px; /* Add spacing between columns */
        }

        .img-carousel {
            height: auto;
            max-width: 100%; /* Adjust image width */
        }
    }
</style>

    <div class="content">
        <div class="left">
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
        </div>
        <div class="right">
            <h2>{{$product->name}}</h2>
            <h4>Rp {{number_format($product->price, 0, ',', '.')}}</h4>
            <p>{!! nl2br($product->description) !!}</p>

            <form action="{{ route('admin.delete_product', $product->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
            </form>

            <a href="{{ route('admin.edit_form', $product->id) }}" class="btn btn-secondary">Update</a>



            

        </div>

    </div>

    <script>
        // Get the input field and initial price value
        const quantityInput = document.querySelector('input[name="quantity"]');
        const initialPrice = {{ $product->price }};
    
        // Function to format number with thousands separators
        function formatNumberWithCommas(number) {
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }
    
        // Function to update the total price
        function updateTotalPrice() {
            const quantity = parseInt(quantityInput.value);
            const totalPrice = initialPrice * quantity;
    
            // Format the total price with thousands separators
            const formattedTotalPrice = formatNumberWithCommas(totalPrice);
    
            // Update the total price display
            document.querySelector('#total-price').textContent = `Total Price: Rp ${formattedTotalPrice}`;
        }
    
        function incrementQuantity() {
            var input = document.getElementById('quantityInput');
            input.value = parseInt(input.value) + 1;
            updateTotalPrice(); // Update total price after changing quantity
        }
    
        function decrementQuantity() {
            var input = document.getElementById('quantityInput');
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
                updateTotalPrice(); // Update total price after changing quantity
            }
        }
    
        // Attach an event listener to the quantity input
        quantityInput.addEventListener('input', updateTotalPrice);
    
        // Initial update of total price
        updateTotalPrice();
    </script>


    
@endsection