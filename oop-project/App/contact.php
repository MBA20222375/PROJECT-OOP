<?php

namespace OopProject;

use PDO;

class Contact {

    public static function create(
        PDO $pdo,
        string $name,
        string $phone,
        string $email,
        string $reason,
        string $message
    ): bool {

        $stmt = $pdo->prepare("
            INSERT INTO contact_messages (name, phone, email, reason, message)
            VALUES (?, ?, ?, ?, ?)
        ");

        return $stmt->execute([
            $name,
            $phone,
            $email,
            $reason,
            $message
        ]);
    }
}
