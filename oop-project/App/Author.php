<?php

namespace Oop\Project;

use PDO;

class Author
{
    private int $id;
    private string $name;
    public function __construct(
        int $id,
        string $name
    ) {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public static function create(
        PDO $pdo,
        string $name
    ): ?Author {

        $stmt = $pdo->prepare("
            INSERT INTO authors (name)
            VALUES (?)
        ");

        $success = $stmt->execute([
            $name,
        ]);

        if (! $success) {
            return null;
        }

        return new self(
            (int) $pdo->lastInsertId(),
            $name
        );
    }

    public static function getAll(PDO $pdo): array
    {
        $stmt = $pdo->query("SELECT * FROM authors");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $authors = [];

        foreach ($rows as $row) {
            $authors[] = new self(
                (int) $row['id'],
                $row['name']
            );
    }

    return $authors;
}


    public static function find(PDO $pdo, string $name): ?Author
    {
        $stmt = $pdo->prepare("SELECT * FROM authors WHERE name = ?");
        $stmt->execute([$name]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (! $row) {
            return null;
        }

        return new self(
            (int) $row['id'],
            $row['name']
        );
    }






}
