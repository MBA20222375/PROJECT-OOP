<?php
require_once "core/functions.php";
require_once "core/validations.php";
require_once "config.php";
require_once "views/layauts/header.php";
require_once "vendor/autoload.php";

use Projeats\ProjectOop\Database;
use Projeats\ProjectOop\Prodaut;


$db = Database::getInstance($config)->getConnection();

$page = $_GET['page'] ?? "home";
switch ($page) {
    case "home":
        require "views/home.php";
        break;
    case "register":
        require "views/auth/account.php";
        break;
    case "logout":
        require "APP/contollers/logoutcontoller.php";
        break;
    case "shop":
        require "views/shop.php";
        break;
    case "branches":
        require "views/branches.php";
        break;
    case "about":
        require "views/about.php";
        break;
    case "contact":
        require "views/contact.php";
        break;
    case "profile":
        require "views/profile.php";
        break;
    case "orders":
        require "views/orders.php";
        break;
    case "account_details":
        require "views/account_details.php";
        break;
    case "favourites":
        require "views/favourites.php";
        break;
    case "checkout":
        require "views/checkout.php";
        break;
    case "order_details":
        require "views/order-details.php";
        break;
    case "order_recieved":
        require "views/order-recieved.php";
        break;
    case "privacy_policy":
        require "views/privacy-policy.php";
        break;
    case "refund_policy":
        require "views/refund-policy.php";
        break;
    case "single_product":
        require "views/single-product.php";
        break;
    case "track_order":
        require "views/track-order.php";
        break;
    case "account-control":
        require "App/controllers/AccountController.php";
        break;
    default:
        //require "views/404.php";
       // break;
}
require_once "./views/layauts/Footer.php";
