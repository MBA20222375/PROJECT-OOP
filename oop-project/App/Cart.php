<?php

namespace Oop\Project;

use PDO;

class Cart
{
    private array $items = [];

    public function __construct()
    {
        if (isset($_SESSION['cart'])) {
            $this->items = $_SESSION['cart'];
        }
    }

    public function add(int $productId, int $quantity = 1): void
    {
        if (isset($this->items[$productId])) {
            $this->items[$productId] += $quantity;
        } else {
            $this->items[$productId] = $quantity;
        }
        $this->saveSession();
    }

    public function remove(int $productId): void
    {
        if (isset($this->items[$productId])) {
            unset($this->items[$productId]);
            $this->saveSession();
        }
    }

    public function update(int $productId, int $quantity): void
    {
        if ($quantity <= 0) {
            $this->remove($productId);
        } else {
            $this->items[$productId] = $quantity;
            $this->saveSession();
        }
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function getTotalItems(): int
    {
        return array_sum($this->items);
    }

    public function clear(): void
    {
        $this->items = [];
        $this->saveSession();
    }

    public function isEmpty(): bool
    {
        return empty($this->items);
    }

    private function saveSession(): void
    {
        $_SESSION['cart'] = $this->items;
    }

    public static function getCartTotal(array $items, PDO $pdo): float
    {
        $total = 0.0;
        
        foreach ($items as $productId => $quantity) {
            $book = Book::find($pdo, $productId);
            if ($book) {
                $price = $book->getPrice();
                $discount = $book->getDiscount();
                $priceAfterDiscount = $book->getPriceAfterDiscount();
                $finalPrice = $discount > 0 ? $priceAfterDiscount : $price;
                $total += $finalPrice * $quantity;
            }
        }
        
        return $total;
    }

    public static function getCartItemsWithDetails(array $items, PDO $pdo): array
    {
        $cartItems = [];
        
        foreach ($items as $productId => $quantity) {
            $book = Book::find($pdo, $productId);
            if ($book) {
                $price = $book->getPrice();
                $discount = $book->getDiscount();
                $priceAfterDiscount = $discount > 0 ? $book->getPriceAfterDiscount() : $price;
                
                $cartItems[] = [
                    'product' => $book,
                    'quantity' => $quantity,
                    'price' => $price,
                    'discount' => $discount,
                    'priceAfterDiscount' => $priceAfterDiscount,
                    'subtotal' => $priceAfterDiscount * $quantity
                ];
            }
        }
        
        return $cartItems;
    }


    public static function getCartTotalDiscount(array $items, PDO $pdo): float
    {
        $total = 0.0;
        
        foreach ($items as $productId => $quantity) {
            $book = Book::find($pdo, $productId);
            if ($book) {
                $price = $book->getPrice();
                $discount = $book->getDiscount();
                $priceAfterDiscount = $book->getPriceAfterDiscount();
                $finalPrice = $discount > 0 ? $priceAfterDiscount : $price;
                $totalBeforeDiscount = $price * $quantity;
                $totalAfterDiscount = $finalPrice * $quantity;
                $total += ($totalBeforeDiscount - $totalAfterDiscount);
            }
        }
        
        return $total;
    }
}
