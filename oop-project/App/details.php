<?php

namespace Oop\Project;

use PDO;

class details
{
    public static function updateInfo(PDO $pdo, int $id, string $name, string $email): bool
    {
        $stmt = $pdo->prepare(
            "UPDATE users SET name = ?, email = ? WHERE id = ?"
        );

        return $stmt->execute([$name, $email, $id]);
    }

    public static function updatePassword(PDO $pdo, int $id, string $password): bool
    {
        $stmt = $pdo->prepare(
            "UPDATE users SET password = ? WHERE id = ?"
        );

        return $stmt->execute([$password, $id]);
    }
}
