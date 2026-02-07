<?php
namespace Oop\Project;

use Oop\Project\Order;
use PDO;

class OrderController{
    public static function handle(PDO $db):void{
        if(!isset($_SESSION['user_id'])){
            header("Location: index.php?page=account");
            die();
        }
        if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] === 'purchase'){
            self::purchase($db);
        }
    }

    public static function purchase(PDO $db):void{
        if(isset(
            $_POST['first_name'],
            $_POST['last_name'],
            $_POST['city'],
            $_POST['address'],
            $_POST['phone'],
            $_POST['email'], 
            $_POST['additional_information']
            )){
                $city = trim(htmlentities($_POST['city']));
                $first_name = trim(htmlentities($_POST['first_name']));
                $last_name = trim(htmlentities($_POST['last_name']));
                $name = $first_name." ".$last_name;
                $address = trim(htmlentities($_POST['address']));
                $phone = trim(htmlentities($_POST['phone']));
                $email = trim(htmlentities($_POST['email']));
                $additional_information = trim(htmlentities($_POST['additional_information']));
                $payment_type = "COD";
                $status = "pending";
                $orderData = [
                    'user_id'=> $_SESSION['user_id'],
                    'city'=> $city,
                    'address'=> $address,
                    'phone'=> $phone,
                    'email'=> $email,
                    'additional_information'=> $additional_information,
                    'payment_type'=> $payment_type,
                    'status'=> $status,
                    'name'=> $name
                ];
                $order = new Order($db);
                $cart = new Cart();
                $orderItems = $cart::getCartItemsWithDetails($cart->getItems(), $db);
                $order_id = $order->createOrder($orderData, $orderItems);

                set_messages([['content'=> 'Order Completed', 'type'=> 'success']]);

                header("Location: index.php?page=order-recieved&id=$order_id");
                die();
            }

    }
}

OrderController::handle($db);

// session_start();

// $userId = $_SESSION['user_id'] ?? 0;

// if (!$userId) {
//     header('Location: index.php?page=account');
//     exit;
// }

// $order = new Order($db);

// $userOrders = [];
// $orderDetails = [];

// $current_page = $_GET['page'] ?? '';

// switch ($current_page) {
//     case 'order_details':
//         $orderId = $_GET['order_id'] ?? 0;
//         $orderDetails = $order->getOrderById($orderId);
//         break;
        
//     case 'order_recieved':
//         $orderId = $_GET['order_id'] ?? 0;
//         $orderDetails = $order->getOrderById($orderId);
//         break;
        
//     case 'orders':
//     default:
//         $userOrders = $order->getUserOrders($userId);
//         break;
// }
