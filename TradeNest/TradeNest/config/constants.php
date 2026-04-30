<?php
define('APP_NAME', 'TradeNest');
define('BASE_URL', 'http://localhost/TradeNest/');
define('UPLOAD_DIR', __DIR__ . '/../assets/uploads/');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Simple Cart Initialization
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
