@extends('user.main')

@section('content')

    <style>

        .container {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: start;
        }

        .left {
            width: 250px;
            margin-right: 50px;
        }

        .img-carousel {
            width: 70%; /* Set the maximum width */
            height: auto; /* Maintain aspect ratio */
            padding: 30px;
        }

        .payment-status {
            display: flex;
            flex-direction: row;
            align-items: baseline;
            justify-content: baseline;
        }

        .confirmed {
            background-color: #A8DF8E; /* Background color */
            padding: 2px 10px;
            margin-left: 5px;
            border: 2px solid #ddd; /* Border properties */
            border-radius: 10px; /* Border radius for rounded corners */
        }

        .not-confirmed {
            color: #ddd;
            background-color: #90A17D; /* Background color */
            padding: 2px 10px;
            margin-left: 5px;
            border: 2px solid #ddd; /* Border properties */
            border-radius: 10px; /* Border radius for rounded corners */
        }

        @media screen and (max-width: 768px) {
            .container {
                flex-direction: column;
                align-items: center;
            }

            .left {
                width: 100%; /* Adjust width for small screens */
                margin-right: 0; /* Remove margin for small screens */
            }

            .img-carousel {
                width: 100%; /* Set full width for small screens */
                max-width: none; /* Remove max-width */
                padding: 15px; /* Adjust padding for smaller images */
            }
        }
    </style>

@if(session()->has('message'))
<div class="alert alert-success" role="alert">
    {{ session('message') }}
</div>
@endif

    @foreach ($orders as $order)
        <div class="container">
            <div class="left">
                <div id="carousel-{{ $order->product->id }}" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        @if ($order->product->images->isEmpty())
                            <div class="carousel-item active">
                                <img src="{{ asset('storage/product-images/empty-image.png') }}" alt="Empty Image" class="d-block w-100 img-carousel">
                            </div>
                        @else
                            <div class="carousel-item active">
                                <img src="{{ asset('storage/product-images/' . $order->product->images[0]->url) }}" alt="{{$order->product->name}}" class="d-block w-100 img-carousel">
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="right">
                <h3>{{$order->product->name}}</h3>
                <p>Quantity: {{$order->quantity}}</p>
                <p>Total: Rp {{number_format($order->quantity * $order->product->price, 0, ',', '.')}}</p>
                <div class="payment-status">
                    <p>Payment Status:</p>
                    @if ($order->paid)
                        <div class="confirmed">Confirmed</div>
                    @else
                        <div class="not-confirmed">Not Confirmed</div>
                    @endif
                </div>
            </div>
        </div>
        <hr>
    @endforeach
@endsection