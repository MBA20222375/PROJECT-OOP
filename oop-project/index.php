<?php

// ob_start();


require_once "vendor/autoload.php";
require_once "App/core/functions.php";
require_once "App/core/validations.php";
require_once "config.php";
require_once "App/views/layouts/header.php";


use Oop\Project\Database;
use Oop\Project\Product;


$db = Database::getInstance($config)->getConnection();

$page = $_GET['page'] ?? "home";
switch ($page) {
    case "home":
        require "App/views/home.php";
        break;
    case "favourites":
        require "App/views/favourites.php";
        break;
    case "favourite-control":
    require "App/controllers/FavouriteController.php";
    break;
    case "search":
        require "App/controllers/SearchController.php";
        break;
    case "create-product":
        require "App/views/Products/create.php";
        break;
    case "store-product":
        require "App/controllers/ProductController.php";
        break;
    case "contact-store":
        require "App/controllers/contact-store.php";
        break;
    case "account":
        require "App/views/auth/account.php";
        break;
    case "shop":
        require "App/views/shop.php";
        break;
    case "branches":
        require "App/views/branches.php";
        break;
    case "about":
        require "App/views/about.php";
        break;
    case "contact":
        require "App/views/contact.php";
        break;
    case "profile":
        require "App/views/profile.php";
        break;
    case "orders":
        require "App/views/orders.php";
        break;
    case "account_details":
        require "App/views/account_details.php";
        break;
    case "checkout":
        require "App/views/checkout.php";
        break;
    case "order_details":
        require "App/views/order-details.php";
        break;
    case "order_recieved":
        require "App/views/order-recieved.php";
        break;
    case "privacy_policy":
        require "App/views/privacy-policy.php";
        break;
    case "refund_policy":
        require "App/views/refund-policy.php";
        break;
    case "single_product":
        require "App/views/single-product.php";
        break;
    case "track_order":
        require "App/views/track-order.php";
        break;
    case "account-control":
        require "App/controllers/AccountController.php";
        break;
    case "logout":
        require "App/controllers/LogoutController.php";
        break;
    default:
        require "App/views/home.php";
        break;
}
require_once "App/views/layouts/footer.php";

ob_end_flush();
?>