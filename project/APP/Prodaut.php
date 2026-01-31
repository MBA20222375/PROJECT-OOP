<?php

namespace Projeats\ProjectOop;

use PDO;



class Prodaut
{
    private int $id;
    private string $name;
    private float $price;

    public function __construct(int $id,  string $name, float $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
    }

    // Getters
    public function getid(): int

    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
    public static function create(PDO $pdo, string $name, float $price): ?Prodaut
    {

        $stmt = $pdo->prepare("INSERT INTO products (name, price) VALUES (?,?)");
        $success = $stmt->execute([$name, $price]);
        if ($success) {
            $id = (int)$pdo->lastInsertId();
            return new self($id, $name, $price);
        }
        return null;
    }
    public static function getAll(PDO $pdo): array
    {
        $stmt = $pdo->query("SELECT * FROM products");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $products = [];
        foreach ($rows as $row) {
            $products[] = new self($row['id'], $row['name'], (float)$row['price']);
        }
        return $products;
    }
    public static function findByid(PDO $pdo, int $id): ?Prodaut
    {
        $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new self($row['id'], $row['name'], (float)$row['price']);
        }
        return null;
    }
}
