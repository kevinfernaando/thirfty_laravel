@extends('user.home');

@section('content')
    <form method="POST" action="{{route('user.order', $product->id)}}">
        @csrf
        
        <h2>Hello {{auth()->user()->name}}</h2>

        <p>Product: {{$product->name}}</p>
        <p>Price: {{$product->price}}</p>

        <label for="">Quantity</label>
        <input name="quantity" type="number" value="1">

        <button>Submit</button>


    </form>
@endsection