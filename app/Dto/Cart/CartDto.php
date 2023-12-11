<?php

namespace App\Dto\Cart;

class CartDto
{
    private array $items = [];
    private float $totalSum = 0;
    private int $totalQuantity = 0;

    public function getItems(): array
    {
        return $this->items;
    }

    public function setItems(array $items): void
    {
        $this->items = $items;
    }

    public function getTotalSum(): float
    {
        return $this->totalSum;
    }

    public function setTotalSym(float $totalSum): void
    {
        $this->totalSum = $totalSum;
    }

    public function getTotalQuantity(): int
    {
        return $this->totalQuantity;
    }

    public function setTotalQuantity(int $totalQuantity): void
    {
        $this->totalQuantity = $totalQuantity;
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