<?php
require_once '../config/database.php';
require_once '../config/constants.php';
require_once '../classes/Product.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header('HTTP/1.1 403 Forbidden');
    exit();
}

$db = Database::getInstance();
$productObj = new Product($db);

$id = $_GET['id'] ?? null;
$user_id = $_SESSION['user_id'];

if ($id && $productObj->delete($id, $user_id)) {
    header('Location: ../index.php?page=dashboard&deleted=1');
} else {
    header('Location: ../index.php?page=dashboard&error=1');
}
exit();
