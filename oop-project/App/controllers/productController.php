<?php

use Oop\Project\Book;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $data = [
        'name'        => $_POST['name'],
        'page_count'  => (int)$_POST['page_count'],
        'price'       => (float)$_POST['price'],
        'discount'    => (float)($_POST['discount'] ?? 0),
        'description' => $_POST['description'] ?? null,
    ];

    $image = $_FILES['image'];

    Book::create($db, $data['name'], $data['page_count'], $data['price'], $data['discount'], $data['description'], $image);

    header("Location: index.php?page=create-product");
    exit;
}
