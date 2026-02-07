<?php

use Oop\Project\Order;

$order = null;
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['track_order'])) {

    $orderNumber = trim($_POST['order_number']);
    $email       = trim($_POST['email']);

    if ($orderNumber && $email) {
        $order = Order::findForTracking($db, $orderNumber, $email);

        if (!$order) {
            $error = "لم يتم العثور على طلب بهذه البيانات.";
        }
    } else {
        $error = "من فضلك أدخل جميع البيانات.";
    }
}
