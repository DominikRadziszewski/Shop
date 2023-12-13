<?php

namespace App\ValueObjects;

use App\Models\Product;

class CartItem
{
    private int $productId;
    private string $name;
    private float $price;
    private ?string $imagePath;
    private int $quantity =0;
    public function __construct(Product $product, int $quantity = 1)
    {
        $this->productId = $product->id;
        $this->name = $product->name;
        $this->price = $product->price;
        $this->imagePath = $product->image_path;
        $this->quantity += $quantity;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

   

    public function getName(): string
    {
        return $this->name;
    }



    public function getPrice(): float
    {
        return $this->price;
    }

   

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getSum(): float
    {
        return $this->price * $this->quantity;
    }

    public function getImagePath(): ?string 
    {
        return $this->imagePath;
    }
    public function addQuantity(Product $product): CartItem
    {
        return new CartItem($product, ++$this->quantity);
    }


}
