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
        return view('cart.index',[
            'cart'=>Session::get('cart',new Cart())
        ]);
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
     public function destroy(Product $product)
     {
         try {
            $cart = Session::get('cart',new Cart());
            Session::put('cart' , $cart->removeItem($product));
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
}
