<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpsertProductRequest;
use App\Models\ProductCategory;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;
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
        return view("products.create",[
            "categories"=> ProductCategory::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UpsertProductRequest $request): RedirectResponse
    {
        $product = new Product($request->validated());
        if ($request->hasFile('image')) {
            $product->image_path = $request->file('image')->store('products');
        }
        $product->save();
        return redirect()->route("products.index")->with('status', __('shop.product.status.store.success'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view("products.show",
        [ "product"=> $product,
        "categories"=> ProductCategory::all()

    ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view("products.edit", [
            "product"=> $product,
            "categories"=> ProductCategory::all()

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpsertProductRequest $request, Product $product):RedirectResponse
    {
        $oldImage_path = $product->image_path;
        $product->fill($request->validated());
        if ($request->hasFile('image')) {
            if(Storage::disk()->exists($oldImage_path)){
                Storage::delete($oldImage_path);
            }
            $product->image_path = $request->file('image')->store('products');
        }
        $product->save(); 
        return redirect()->route("products.index")->with('status', __('shop.product.status.update.success'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete(); 
            session()->flash('status', __('shop.product.status.delete.success')) ;
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
    public function donwloadImage(Product $product):RedirectResponse|StreamedResponse
    {
            if(Storage::disk()->exists($product->image_path)){
                return Storage::download($product->image_path);
            }
        return Response::back();
    }
}
