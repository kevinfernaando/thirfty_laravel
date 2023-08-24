<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;

class OrderController extends Controller
{

    public function orderForm($id) {
        $product = Product::find($id);
        return view('user.orderForm', [
            "product" => $product
        ]);
    }

    public function order(Request $request, $id) {
        $order = new Order;
        $order->user_id = Auth::user()->id;
        $order->product_id = $id;
        $order->quantity = $request->quantity;

        $order->save();

        return redirect()->route('user.orders')->with([
            "message" => "Order successfully created!"
        ]);
    }

    public function search(Request $request) {
        $query = $request->input('query');

        $orders = Order::whereHas('user', function ($queryBuilder) use ($query) {
            $queryBuilder->where('name', 'like', "%$query%");
        })->get();

        return view('admin.orders', compact('orders'));
    }

    public function filter(Request $request, $query) {

        if ($query == "paid") {
            $orders = Order::where('paid', true)->get();
        } else if ($query == "unpaid") {
            $orders = Order::where('paid', false)->get();
        } else if ($query == "ready") {
            $orders = Order::where('ready', true)->get();
        } else if ($query == 'notready') {
            $orders = Order::where('ready', false)->get();
        } else {
            $orders = Order::all();
        }

        return view('admin.orders', [
            'orders' => $orders
        ]);

    }

    public function orders(Request $request) {
        $user = Auth::user();

        if ($user->role == 1) {
            $orders = $user->orders()->orderBy('created_at', 'desc')->get();
            $view = 'user.orders';
        } else {
            $orders = Order::all()->orderBy('created_at', 'desc')->get();
            $view = 'admin.orders';
        }

        return view($view, [
            'orders' => $orders
        ]);
    }

    public function paid(Request $request, $id) {
        $order = Order::find($id);
        $order->paid = true;
        $order->save();

        return redirect()->route('admin.orders');
    }

    public function ready(Request $request, $id) {
        $order = Order::find($id);
        $order->ready = true;
        $order->save();

        return redirect()->route('admin.orders');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::all();

        return view('admin.orders', [
            "orders" => $orders
        ]);
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
