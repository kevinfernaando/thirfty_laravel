@extends('admin.main')

@section('content')

<style>
    .search-filter {
        display: flex;
        flex-direction: row;
    }
</style>

<!-- Example single danger button -->
    <div class="search-filter mb-2">
        <div class="btn-group mr-3">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Filter
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{route('admin.orders')}}">All</a>
                <a class="dropdown-item" href="{{route('admin.orders_filter', 'paid')}}">Paid</a>
                <a class="dropdown-item" href="{{route('admin.orders_filter', 'unpaid')}}">Unpaid</a>
                <a class="dropdown-item" href="{{route('admin.orders_filter', 'ready')}}">Ready</a>
                <a class="dropdown-item" href="{{route('admin.orders_filter', 'notready')}}">Not Ready</a>
            </div>
        </div>

        <form action="{{ route('admin.search_orders') }}" method="GET" class="form-inline">
            <div class="input-group">
                <input type="text" name="query" class="form-control" placeholder="Search...">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>
    </div>

    <table class="table">
    <thead class="thead-dark">
    <tr>
      <th scope="col">Order ID</th>
      <th scope="col">Name</th>
      <th scope="col">Product</th>
      <th scope="col">Price</th>
      <th scope="col">Quantity</th>
      <th scope="col">Total Price</th>
      <th scope="col">Order Created</th>
      <th scope="col">Paid</th>
      <th scope="col">Ready</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($orders as $order)
        <tr>
            <th scope="row">{{$order->id}}</th>
            <td>{{$order->user->name}}</td>
            <td><a href="{{ route('user.product', $order->product->id) }}">{{ \Illuminate\Support\Str::limit($order->product->name, 30, $end = '...') }}</a></td>
            <td>Rp {{ number_format($order->product->price, 0, ',', '.')  }}</td>
            <td>{{$order->quantity}}</td>
            <td>Rp {{ number_format($order->quantity * $order->product->price, 0, ',', '.')  }}</td>
            <td>{{$order->created_at->format('Y-m-d H:i:s') }}</td>


            @if ($order->paid)
                <td>Payment Confirmed</td>
            @else
            <td>
                <form action="{{route('admin.paid', $order->id)}}" method="POST">
                    @method("PUT")
                    @csrf
                    
                    <button class="btn btn-success">Confirm Payment</button>
                </form>
            </td>
            @endif

            @if ($order->ready)
                <td>Product Ready</td>
            @else
            <td>
                <form action="{{route('admin.ready', $order->id)}}" method="POST">
                    @method("PUT")
                    @csrf
                    
                    <button class="btn btn-success" >Confirm Ready</button>
                </form>
            </td>
            @endif
      </tr>
    @endforeach
    
    
@endsection