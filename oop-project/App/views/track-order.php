<?php
$order = null;
$order_items = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order_id = trim($_POST['order_id']);
    $email    = trim($_POST['email']);

    $stmt = $pdo->prepare("
        SELECT *
        FROM orders
        WHERE id = ? AND email = ?
        LIMIT 1
    ");
    $stmt->execute([$order_id, $email]);
    $order = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($order) {
        $itemsStmt = $pdo->prepare("
            SELECT 
                order_items.qty,
                order_items.book_price,
                order_items.book_discount,
                books.name
            FROM order_items
            JOIN books ON books.id = order_items.book_id
            WHERE order_items.order_id = ?
        ");
        $itemsStmt->execute([$order['id']]);
        $order_items = $itemsStmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
