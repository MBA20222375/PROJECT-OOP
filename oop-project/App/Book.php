<?php

namespace Oop\Project;

use Oop\Project\Traits\ManagesFiles;
use PDO;

class Book
{
    use ManagesFiles;

    private int $id;
    private string $name;
    private int $page_count;
    private float $price;
    private float $discount;
    private ?string $image;
    private ?string $description;

    public function __construct(
        int $id,
        string $name,
        int $page_count,
        float $price,
        float $discount = 0,
        ?string $image = null,
        ?string $description = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->page_count = $page_count;
        $this->price = $price;
        $this->discount = $discount;
        $this->image = $image;
        $this->description = $description;
    }

    /* ================= Getters ================= */

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPageCount(): int
    {
        return $this->page_count;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getDiscount(): float
    {
        return $this->discount;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    /* ================= CRUD ================= */

    public static function create(
        PDO $pdo,
        string $name,
        int $page_count,
        float $price,
        float $discount,
        ?string $description,
        $image
    ): ?Book {
        $imageName = null;

        if ($image && is_array($image)) {
            $imageName = self::uploadFile($image, 'books');
        }

        $stmt = $pdo->prepare("
            INSERT INTO books (name, page_count, price, discount, description, image)
            VALUES (?, ?, ?, ?, ?, ?)
        ");

        $success = $stmt->execute([
            $name,
            $page_count,
            $price,
            $discount,
            $description,
            $imageName
        ]);

        if ($success) {
            return new self(
                (int)$pdo->lastInsertId(),
                $name,
                $page_count,
                $price,
                $discount,
                $imageName,
                $description
            );
        }

        return null;
    }

    public static function getAll(PDO $pdo): array
    {
        $stmt = $pdo->query("SELECT * FROM books");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $books = [];
        foreach ($rows as $row) {
            $books[] = new self(
                $row['id'],
                $row['name'],
                $row['page_count'],
                (float)$row['price'],
                (float)$row['discount'],
                $row['image'],
                $row['description']
            );
        }

        return $books;
    }

    public static function findById(PDO $pdo, int $id): ?Book
    {
        $stmt = $pdo->prepare("SELECT * FROM books WHERE id = ?");
        $stmt->execute([$id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new self(
                $row['id'],
                $row['name'],
                $row['page_count'],
                (float)$row['price'],
                (float)$row['discount'],
                $row['image'],
                $row['description']
            );
        }

        return null;
    }

    // SEARCH  FUNCTION

    public static function search(PDO $pdo, string $keyword): array
    {
        $stmt = $pdo->prepare("
            SELECT * FROM books
            WHERE name LIKE :q
               OR description LIKE :q
        ");

        $stmt->execute([
            ':q' => '%' . $keyword . '%'
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function update(
        PDO $pdo,
        int $id,
        string $name,
        int $page_count,
        float $price,
        float $discount,
        ?string $description,
        $image = null
    ): bool {
        $imageName = null;

        if ($image && is_array($image) && $image['error'] === UPLOAD_ERR_OK) {
            $imageName = self::uploadFile($image, 'books');
            $stmt = $pdo->prepare("
                UPDATE books 
                SET name = ?, page_count = ?, price = ?, discount = ?, description = ?, image = ?
                WHERE id = ?
            ");
            return $stmt->execute([$name, $page_count, $price, $discount, $description, $imageName, $id]);
        } else {
            $stmt = $pdo->prepare("
                UPDATE books 
                SET name = ?, page_count = ?, price = ?, discount = ?, description = ?
                WHERE id = ?
            ");
            return $stmt->execute([$name, $page_count, $price, $discount, $description, $id]);
        }
    }

    public static function delete(PDO $pdo, int $id): bool
    {
        $stmt = $pdo->prepare("DELETE FROM books WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
