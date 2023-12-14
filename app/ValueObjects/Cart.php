<?php

namespace App\ValueObjects;

use App\Models\Product;
use App\ValueObjects\CartItem;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;

class Cart
{
    private Collection $items;
  
    public function __construct(Collection $items = null)
    {
        $this->items = $items ?? Collection::empty();
    }

    public function getItems(): Collection
    {
        return $this->items;
    }
    public function getSum(): float
    {
        return $this->items->sum(function ($item) {
            return $item->getPrice() * $item->getQuantity();
        });
    }
    public function addItem(Product $product): Cart
    {
        $items = $this->items;
        $item = $items->first($this->isProductIdSameAsItemProduct($product));
        if(!is_null($item)){
            $items = $this->removeItemFormCollection($items, $product);
            $newItem = $item->addQuantity($product);
        }else{
           $newItem = new CartItem($product);
        }
       $items->add($newItem);
        return new Cart($items);
    }

    public function isProductIdSameAsItemProduct(Product $product){
        return function($item) use ($product){
            return $product->id == $item->getProductId(); 
         };
    }

    public function removeItem(Product $product): Cart
    {
        $items = $this->removeItemFormCollection($this->items, $product);
        return new Cart($items);
    }

    private function removeItemFormCollection(Collection $items, Product $product)
    {
        return $items->reject($this->isProductIdSameAsItemProduct($product));
    }
}