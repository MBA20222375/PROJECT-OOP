<?php

use Oop\Project\Book;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Handle Update
    if (isset($_GET['page']) && $_GET['page'] === 'update-product') {
        $id = $_POST['id'];
        
        $data = [
            'name'        => $_POST['name'],
            'page_count'  => (int)$_POST['page_count'],
            'price'       => (float)$_POST['price'],
            'discount'    => (float)($_POST['discount'] ?? 0),
            'description' => $_POST['description'] ?? null,
        ];

        $image = $_FILES['image'] ?? null;

        Book::update($db, $id, $data['name'], $data['page_count'], $data['price'], $data['discount'], $data['description'], $image);

        header("Location: index.php?page=create-product");
        exit;
    }
    
    // Handle Create (original code)
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

// Handle Delete
if (isset($_GET['page']) && $_GET['page'] === 'delete-product' && isset($_GET['id'])) {
    $id = $_GET['id'];
    Book::delete($db, $id);
    header("Location: index.php?page=create-product");
    exit;
}
