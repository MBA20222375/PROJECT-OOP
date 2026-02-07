<?php

namespace Oop\Project;

use DateTime;
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
    private DateTime $created_at;
    private string $category;

    public function __construct(
        int $id,
        string $name,
        int $page_count,
        float $price,
        DateTime $created_at,
        string $category,
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
        $this->created_at = $created_at;
        $this->category = $category;
    }

    /* ================= Getters ================= */

    public function getId(): int
    {
        return $this->id;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->created_at;
    }

    public function getCategory(){
        return $this->category;
    }

    public function isRecent(): bool
    {
        return $this->created_at->diff(new DateTime())->days < 7;
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

    public function getPriceAfterDiscount(): float
    {
        return $this->price - ($this->price * $this->discount / 100);
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    /* ================= CREATE ================= */

    public static function create(
        PDO $pdo,
        string $name,
        int $page_count,
        float $price,
        float $discount,
        ?string $description,
        array $image,
        string $category
    ): ?Book {

        $imageName = "";
        if ($image && is_array($image)) {
            $imageName = self::uploadFile($image, 'books');
        }

        $stmt = $pdo->prepare("
            INSERT INTO books (name, page_count, price, discount, description, image, category)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");

        $success = $stmt->execute([
            $name,
            $page_count,
            $price,
            $discount,
            $description,
            $imageName,
            $category
        ]);

        if (!$success) {
            return null;
        }

        return new self(
            (int) $pdo->lastInsertId(),
            $name,
            $page_count,
            $price,
            new DateTime(),
            $category,
            $discount,
            $imageName,
            $description,
        );
    }

    /* ========== CREATE WITH RELATIONS ========== */

    public static function createWithRelations(
        PDO $pdo,
        string $name,
        int $page_count,
        float $price,
        float $discount,
        string $description,
        array $image,
        string $authorName,
        string $category,
    ): ?Book {

        $book = self::create(
            $pdo,
            $name,
            $page_count,
            $price,
            $discount,
            $description,
            $image,
            $category
        );

        if (!$book) {
            return null;
        }

        $bookId = $book->getId();

        $author = Author::find($pdo, $authorName);
        if (!null) {
            $author = Author::create($pdo, $authorName);
        }

        self::setAuthorsBooks($pdo, $author->getId(), $bookId);

        // foreach ($tagIds as $tagId) {
        //     $pdo->prepare("
        //         INSERT INTO books_tags (book_id, tag_id)
        //         VALUES (?, ?)
        //     ")->execute([$bookId, $tagId]);
        // }

        return $book;
    }
    public static function getAll(PDO $pdo): array
    {
        $stmt = $pdo->query("SELECT * FROM books ORDER BY created_at DESC");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $books = [];

        foreach ($rows as $row) {
            $books[] = new self(
                (int) $row['id'],
                $row['name'],
                (int) $row['page_count'],
                (float) $row['price'],
                new DateTime($row['created_at']),
                $row['category'],
                (float) $row['discount'],
                $row['image'],
                $row['description'],
            );
        }

        return $books;
    }

    public static function getProductByID(PDO $pdo, int $id): Book|null
    {
        $stmt = $pdo->prepare("SELECT * FROM books WHERE id = ? LIMIT 1");
        if (!$stmt) {
            return null;
        }

        $stmt->execute([$id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            return null;
        }

        $book = new self(
            (int) $row['id'],
            $row['name'],
            (int) $row['page_count'],
            (float) $row['price'],
            new DateTime($row['created_at']),
            $row['category'],
            (float) $row['discount'],
            $row['image'],
            $row['description'],
        );

        return $book;
    }


    public static function getFavouriteBooks(PDO $pdo, int $userId): array|null
    {
        $stmt = $stmt = $pdo->prepare(
            "SELECT b.*
                FROM favourites f
                JOIN books b ON b.id = f.book_id
                WHERE f.user_id = ?"
        );
        if (!$stmt) {
            return null;
        }
        $stmt->execute([$userId]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (!$rows) {
            return null;
        }

        $books = [];
        foreach ($rows as $row) {
            $books[] = new self(
                (int) $row['id'],
                $row['name'],
                (int) $row['page_count'],
                (float) $row['price'],
                new DateTime($row['created_at']),
                $row['category'],
                (float) $row['discount'],
                $row['image'],
                $row['description'],
            );
        }

        return $books;
    }


    /* ================= SEARCH ================= */

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

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $books = [];
        foreach ($rows as $row) {
            $books[] = new self(
                $row['id'],
                $row['name'],
                $row['page_count'],
                (float) $row['price'],
                new DateTime($row['created_at']),
                $row['category'],
                (float) $row['discount'],
                $row['image'],
                $row['description'],
            );
        }

        return $books;
    }


    public function getAuthors(PDO $pdo): array
    {
        $stmt = $pdo->prepare("
            SELECT a.*
            FROM authors a
            JOIN books_authors ba ON a.id = ba.author_id
            WHERE ba.book_id = ?
        ");
        $stmt->execute([$this->id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function setAuthorsBooks(PDO $pdo, $authorId, $bookId): int|null
    {
        $stmt = $pdo->prepare("INSERT INTO books_authors(book_id, author_id) values(?, ?);");

        if (!$stmt->execute([$bookId, $authorId])) {
            return null;
        }

        return $pdo->lastInsertId();
    }

    public function getTags(PDO $pdo): array
    {
        $stmt = $pdo->prepare("
            SELECT t.*
            FROM tags t
            JOIN books_tags bt ON t.id = bt.tag_id
            WHERE bt.book_id = ?
        ");
        $stmt->execute([$this->id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function find(PDO $pdo, int $id): ?Book
    {
        $stmt = $pdo->prepare("SELECT * FROM books WHERE id = ?");
        $stmt->execute([$id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        return new self(
            (int) $row['id'],
            $row['name'],
            (int) $row['page_count'],
            (float) $row['price'],
            new DateTime($row['created_at']),
            $row['category'],
            (float) $row['discount'],
            $row['image'],
            $row['description'],
        );
    }

    public static function getTop10Sold(PDO $pdo): ?array
    {
        $stmt = $pdo->query("SELECT 
            b.*
            FROM order_items oi
            JOIN books b ON b.id = oi.book_id
            GROUP BY b.id
            ORDER BY SUM(oi.qty) DESC
            LIMIT 10;
            ");

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!$rows) {
            return null;
        }

        $books = [];
        foreach($rows as $row){
            $books[] = new self(
                (int) $row['id'],
                $row['name'],
                (int) $row['page_count'],
                (float) $row['price'],
                new DateTime($row['created_at']),
                $row['category'],
                (float) $row['discount'],
                $row['image'],
                $row['description'],
            );
        }
        return $books;
    }


    public static function getBooksByCategory(PDO $pdo, string $category): ?array
    {
        $stmt = $pdo->prepare("SELECT * FROM books WHERE category = ? ;");

        if(!$stmt){
            return [];
        }

        $stmt->execute([$category]);

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!$rows) {
            return null;
        }

        $books = [];
        foreach($rows as $row){
            $books[] = new self(
                (int) $row['id'],
                $row['name'],
                (int) $row['page_count'],
                (float) $row['price'],
                new DateTime($row['created_at']),
                $row['category'],
                (float) $row['discount'],
                $row['image'],
                $row['description'],
            );
        }
        return $books;
    }
}
