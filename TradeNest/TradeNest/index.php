<?php
require_once 'config/database.php';
require_once 'config/constants.php';
require_once 'classes/User.php';
require_once 'classes/Product.php';
require_once 'classes/Order.php';

$db = Database::getInstance();
$userObj = new User($db);
$productObj = new Product($db);
$orderObj = new Order($db);

$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$public_pages = ['home', 'login', 'signup', 'product_list', 'product_detail', '404'];

if (!in_array($page, $public_pages) && !User::isLoggedIn()) {
    header('Location: index.php?page=login');
    exit();
}

switch ($page) {
    case 'home':
        include 'pages/home.php';
        break;
    case 'login':
        include 'pages/login.php';
        break;
    case 'signup':
        include 'pages/signup.php';
        break;
    case 'dashboard':
        include 'pages/dashboard.php';
        break;
    case 'profile':
        include 'pages/profile.php';
        break;
    case 'product_list':
        include 'pages/product_list.php';
        break;
    case 'product_detail':
        include 'pages/product_detail.php';
        break;
    case 'add_product':
        include 'pages/add_product.php';
        break;
    case 'edit_product':
        include 'pages/edit_product.php';
        break;
    case 'cart':
        include 'pages/cart.php';
        break;
    case 'orders':
        include 'pages/orders.php';
        break;
    case 'order_detail':
        include 'pages/order_detail.php';
        break;
    case 'logout':
        User::logout();
        header('Location: index.php?page=home');
        break;
    default:
        include 'pages/404.php';
        break;
}
