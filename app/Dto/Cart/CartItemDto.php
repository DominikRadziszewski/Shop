<?php

namespace App\Dto\Cart;

class CartItemDto
{
    private int $productId;
    private string $name;
    private float $price;
    private int $quantity;
    private ?string $imagePath;

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function setProductId(int $productId): void
    {
        $this->productId = $productId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function getImagePath(): ?string 
    {
        return $this->imagePath;
    }

    public function setImagePath(?string $imagePath): void
    {
        $this->imagePath = $imagePath;
    }
    public function incrementQuantity(): void
    {
        $this->quantity += 1;
    }
    public function incrementTotalQuantity(): void
    {
        $this->totalQuantity += 1;
    }
    public function incrementTotalSum(float $price): void
    {
        $this->totalSum += $price;
    }
}
