<?php


namespace App\Http\Controllers;

use App\Dto\Cart\CartDto;
use App\Dto\Cart\CartItemDto;
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
        dd(Session::get('cart',new CartDto()));
        return view('home');
    }
    /**
     * @param Product $product
     * @return JsonResponse
     */
    public function store(Product $product): JsonResponse
    {
        $cart = Session::get('cart',new CartDto());
        $itmes = $cart->getItems();
        if(Arr::exists($itmes, $product->id)){
            $itmes[$product->id]->incrementQuantity();
        }else{
            $cartItemDto = new CartItemDto();
            $cartItemDto->setProductId($product->id);
            $cartItemDto->setName($product->name);
            $cartItemDto->setPrice($product->price);
            $cartItemDto->setImagePath($product->image_path);
            $cartItemDto->setQuantity(1);
            $itmes[$product->id]= $cartItemDto;
        }
        $cart->setItems($itmes);
        $cart->incrementTotalQuantity();
        $cart->incrementTotalSum($product->price);

       Session::put('cart' , $cart);
        return response()->json([
            'status'=>'success'
        ]);   
     }
}
