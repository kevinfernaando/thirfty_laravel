<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('active', true)->get();

        if (Auth::check() && Auth::user()->role == 0) {
            $view = 'admin.products';
        } else {
            $view = 'user.products';
        }

        return view($view, [
            "products" => $products
        ]);
        //
    }

    public function search(Request $request) {

        if (Auth::check() && Auth::user()->role == 0) {
            $view = 'admin.products';
        } else {
            $view = 'user.products';
        }

        $query = $request->input('query');

        $products = Product::where(function ($queryBuilder) use ($query) {
            $queryBuilder->where('name', 'like', "%$query%")
                        ->orWhere('description', 'like', "%$query%");
        })
        ->where('active', true)
        ->get();

        return view($view, compact('products'));
    }

    public function detail(Request $request, $id) {
        $product = Product::find($id);

        if (Auth::check() && Auth::user()->role == 0) {
            $view = 'admin.detail';
        } else {
            $view = 'user.detail';
        }

        return view($view, compact('product'));
    }


    public function create(Request $request)
    {
        return view('admin.create_product_form');

        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

  
        $validatedData = $request->validate([
            "name" => "required",
            "description" => "required",
            "price" => ["required", "numeric"],
        ]);

        $product = Product::create($validatedData);

        for ($i = 1; $i <= 3; $i++) {
            if ($request->file('image' . $i)) {
                $uploadedImage = $request->file('image' . $i);
                $storedPath = $uploadedImage->store('product-images');
                $imageName = basename($storedPath);


                $image = new Image();
                $image->product_id = $product->id;
                $image->url = $imageName;

                $image->save();
            }
        }

        // $product = Product::create($validatedData);

        return redirect()->route('admin.products');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('admin.edit_form', [
            "product" => $product
        ]);
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            "name" => "required",
            "description" => "required",
            "price" => ["required", "numeric"]
        ]);

        $product = Product::find($id);
        $images = $product->images;
        
        for ($i = 1; $i <= 3; $i++) {
            if ($request->file('image' . $i)) {
                $uploadedImage = $request->file('image' . $i);
                $storedPath = $uploadedImage->store('product-images');
                $imageName = basename($storedPath);

                if (!isset($images[$i-1])) {
                    $image = new Image();
                    $image->product_id = $product->id;
                    $image->url = $imageName;
                    
                    $image->save();
                } else {
                    $image = $images[$i-1];
                    $image->url = $imageName;
                    
                    $image->update();
                }
            }
        }
        
        $product->update($validatedData);
        return redirect()->route('admin.products');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->active = false;
        $product->save();

        return redirect()->route('admin.products');
    }



    // public function order($id) {
        
    // }
}
