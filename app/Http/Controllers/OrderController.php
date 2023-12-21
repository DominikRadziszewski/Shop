<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Controllers\Controller;
use App\ValueObjects\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("orders.index" , [
            "orders"=> Order::where('user_id', Auth::id())->paginate(10)
        ]);
    }


    public function store(Request $request)
    {
        $cart = Session::get('cart', new Cart());
        if($cart->hasItems()){
        $order = new Order();
        $order->quantity = $cart->getEndQuantity();
        $order->price = $cart->getSum();
        $order->user_id = Auth::id();
        $order->save();
        
        $productsIds= $cart->getItems()->map(function($item){
            return ['product_id' => $item->getProductId()];
        });
        $order->products()->attach($productsIds);
        
        Session::put('cart', new Cart());
        return redirect()->route("orders.index")->with('status', __('Zamówienie zrealizowane'));
            }
         return back();
    }

    
}
