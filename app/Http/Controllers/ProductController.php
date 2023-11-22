<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use View;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("products.index",
        ["products"=> Product::paginate(10)
    ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("products.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = new Product($request->all());
        if ($request->hasFile('image')) {
            $product->image_path = $request->file('image')->store('products');
        }
        $product->save();
        return redirect()->route("products.index")->with("success","");
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view("products.show",
        [ "product"=> $product
    ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view("products.edit", [
            "product"=> $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $product->fill($request->all());
        if ($request->hasFile('image')) {
            $product->image_path = $request->file('image')->store('products');
        }
        $product->save(); 
        return redirect()->route("products.index")->with("success","");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete();   
            return response()->json([
                'status'=>'success'
            ]);
           } catch (\Throwable $th) {
            return response()->json([
                'status'=>'error',
                'message'=> 'Wystąpił błąd!'
            ])->setStatusCode (500);
           }
    }
}
