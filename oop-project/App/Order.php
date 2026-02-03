<?php

namespace Oop\Project;

use PDO;

class Order
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function getUserOrders(int $userId): array
    {
        $stmt = $this->connection->prepare("
            SELECT o.*, oi.quantity, oi.price as item_price, 
                   p.name as product_name, p.image as product_image,
                   CONCAT(u.first_name, ' ', u.last_name) as customer_name,
                   u.email as customer_email, u.phone as customer_phone
            FROM orders o
            LEFT JOIN order_items oi ON o.id = oi.order_id
            LEFT JOIN products p ON oi.product_id = p.id
            LEFT JOIN users u ON o.user_id = u.id
            WHERE o.user_id = :user_id
            ORDER BY o.created_at DESC
        ");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOrderById(int $orderId)
    {
        $stmt = $this->connection->prepare("
            SELECT o.*, oi.quantity, oi.price as item_price, 
                   p.name as product_name, p.image as product_image,
                   CONCAT(u.first_name, ' ', u.last_name) as customer_name,
                   u.email as customer_email, u.phone as customer_phone,
                   u.address as customer_address
            FROM orders o
            LEFT JOIN order_items oi ON o.id = oi.order_id
            LEFT JOIN products p ON oi.product_id = p.id
            LEFT JOIN users u ON o.user_id = u.id
            WHERE o.id = :order_id
        ");
        $stmt->execute(['order_id' => $orderId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createOrder(array $orderData): int
    {
        $stmt = $this->connection->prepare("
            INSERT INTO orders (user_id, total_amount, status, payment_method, shipping_address, created_at)
            VALUES (:user_id, :total_amount, :status, :payment_method, :shipping_address, NOW())
        ");
        
        $stmt->execute([
            'user_id' => $orderData['user_id'],
            'total_amount' => $orderData['total_amount'],
            'status' => $orderData['status'] ?? 'pending',
            'payment_method' => $orderData['payment_method'],
            'shipping_address' => $orderData['shipping_address']
        ]);
        
        return $this->connection->lastInsertId();
    }

    public function addOrderItem(int $orderId, int $productId, int $quantity, float $price): void
    {
        $stmt = $this->connection->prepare("
            INSERT INTO order_items (order_id, product_id, quantity, price)
            VALUES (:order_id, :product_id, :quantity, :price)
        ");
        
        $stmt->execute([
            'order_id' => $orderId,
            'product_id' => $productId,
            'quantity' => $quantity,
            'price' => $price
        ]);
    }

    public function updateOrderStatus(int $orderId, string $status): void
    {
        $stmt = $this->connection->prepare("
            UPDATE orders SET status = :status WHERE id = :order_id
        ");
        $stmt->execute(['status' => $status, 'order_id' => $orderId]);
    }
}
