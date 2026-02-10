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
        SELECT * FROM orders WHERE user_id = ?;
        ");

        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllOrders(): array
    {
        $stmt = $this->connection->query("
        SELECT * FROM orders;
        ");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getOrderById(PDO $db, int $orderId): array
    {
        $stmt = $db->prepare("
            SELECT * FROM orders
            WHERE id = ?
        ");
        $stmt->execute([$orderId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getOrderItemsById(PDO $db, int $orderId): array
    {
        $stmt = $db->prepare("
            SELECT * FROM order_items
            WHERE order_id = ?
        ");
        $stmt->execute([$orderId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getOrderTotal(PDO $db, int $orderId): array
    {
        $stmt = $db->prepare("
            SELECT SUM(oi.book_price * oi.qty) AS total
            FROM order_items oi
            WHERE oi.order_id = ?;
        ");
        $stmt->execute([$orderId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function createOrder(array $orderData, array $orderItems): int
    {
        $stmt = $this->connection->prepare("
            INSERT INTO orders (user_id, name, city, address, phone, email, payment_type, additional_information,  status)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");

        $stmt->execute([
            $orderData['user_id'],
            $orderData['name'],
            $orderData['city'],
            $orderData['address'],
            $orderData['phone'],
            $orderData['email'],
            $orderData['payment_type'],
            $orderData['additional_information'],
            $orderData['status']
        ]);

        $order_id = $this->connection->lastInsertId();

        foreach ($orderItems as $item) {
            $product_id = $item['product']->getId();
            $quantity = $item['quantity'];
            $price = $item['product']->getDiscount === 0 ? $item['product']->getPrice() : $item['product']->getPriceAfterDiscount();
            $discount = $item['product']->getDiscount();
            $this->addOrderItem($order_id, $product_id, $quantity, $price, $discount);
        }

        return $order_id;
    }

    public function addOrderItem(int $orderId, int $productId, int $quantity, float $price, float $discount): void
    {
        $stmt = $this->connection->prepare("
            INSERT INTO order_items (order_id, book_id, qty, book_price, book_discount)
            VALUES (?, ?, ?, ?, ?)
        ");

        $stmt->execute([
            $orderId,
            $productId,
            $quantity,
            $price,
            $discount
        ]);
    }

    public function updateOrderStatus(int $orderId, string $status): void
    {
        $stmt = $this->connection->prepare("
            UPDATE orders SET status = ? WHERE id = ?
        ");
        $stmt->execute([$status, $orderId]);
    }

    public static function getOrderItemsByOrderId(PDO $db, int $id):array{
        $stmt = $db->prepare("
            SELECT oi.* FROM
            orders o LEFT JOIN order_items oi
            ON o.id = oi.order_id
            WHERE o.id = ?
            ;
        ");
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
