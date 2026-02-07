<?php

use Oop\Project\Book;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name        = $_POST['name'];
    $pageCount  = (int) $_POST['page_count'];
    $price      = (float) $_POST['price'];
    $discount   = (float) ($_POST['discount']);
    $description = $_POST['description'];

    $author   = $_POST['author'];
    $category = $_POST['category'];
    //$tagIds      = $_POST['tag'];

    $image = $_FILES['image'] ?? null;

    Book::createWithRelations(
        $db,
        $name,
        $pageCount,
        $price,
        $discount,
        $description,
        $image,
        $author,
        $category
    );

    header("Location: index.php?page=create-product");
    exit;
}
