<?php

use Oop\Project\Cart;
use Oop\Project\Book;

session_start();

$cart = new Cart();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_to_cart') {
    $productId = (int)$_POST['product_id'];
    $quantity = (int)($_POST['quantity'] ?? 1);
    
    $cart->add($productId, $quantity);
    
    if (isset($_POST['ajax'])) {
        echo json_encode([
            'success' => true,
            'cart_count' => $cart->getTotalItems()
        ]);
        exit;
    }
    
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_cart') {
    if (isset($_POST['quantities']) && is_array($_POST['quantities'])) {
        foreach ($_POST['quantities'] as $productId => $quantity) {
            $cart->update((int)$productId, (int)$quantity);
        }
    }
    
    header("Location: index.php?page=cart");
    exit;
}

if (isset($_GET['action']) && $_GET['action'] === 'remove' && isset($_GET['product_id'])) {
    $productId = (int)$_GET['product_id'];
    $cart->remove($productId);
    
    header("Location: index.php?page=cart");
    exit;
}

if (isset($_GET['action']) && $_GET['action'] === 'clear') {
    $cart->clear();
    
    header("Location: index.php?page=cart");
    exit;
}
