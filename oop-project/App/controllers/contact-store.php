<?php

use OopProject\Contact;

class ContactController {

    public static function store(PDO $pdo): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return;
        }

        $name = trim(htmlspecialchars($_POST['name']));
        $phone = trim(htmlspecialchars($_POST['phone']));
        $email = trim(htmlspecialchars($_POST['email']));
        $reason = trim(htmlspecialchars($_POST['reason']));
        $message = trim(htmlspecialchars($_POST['message']));

        Contact::create(
            pdo: $pdo,
            name: $name,
            phone: $phone,
            email: $email,
            reason: $reason,
            message: $message
        );

        set_messages([
            ['content' => 'success snet message', 'type' => 'success']
        ]);

        header("Location: index.php?page=contact");
        exit;
    }
}
