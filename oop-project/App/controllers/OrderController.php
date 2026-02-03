<?php

use Oop\Project\Order;

session_start();

// Get current user ID (assuming user is logged in)
$userId = $_SESSION['user_id'] ?? 0;

if (!$userId) {
    // Redirect to login if not logged in
    header('Location: index.php?page=account');
    exit;
}

$order = new Order($db);

// Initialize variables
$userOrders = [];
$orderDetails = [];

// Handle different order actions based on the current page
$current_page = $_GET['page'] ?? '';

switch ($current_page) {
    case 'order_details':
        $orderId = $_GET['order_id'] ?? 0;
        $orderDetails = $order->getOrderById($orderId);
        break;
        
    case 'order_recieved':
        $orderId = $_GET['order_id'] ?? 0;
        $orderDetails = $order->getOrderById($orderId);
        break;
        
    case 'orders':
    default:
        $userOrders = $order->getUserOrders($userId);
        break;
}
