<?php


namespace App\Http\Controllers;

use App\ValueObjects\Cart;
use App\ValueObjects\CartItem;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Symfony\Component\HttpFoundation\Session\Session as SessionSession;

class CartController extends Controller
{

    public function index()
    {
        dd(Session::get('cart',new Cart()));
        return view('home');
    }
    /**
     * @param Product $product
     * @return JsonResponse
     */
    public function store(Product $product): JsonResponse
    {
        $cart = Session::get('cart',new Cart());
       Session::put('cart' , $cart->addItem($product));
        return response()->json([
            'status'=>'success'
        ]);   
     }
}
