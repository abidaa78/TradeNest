<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo APP_NAME; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php"><?php echo APP_NAME; ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php?page=product_list">Explore</a></li>
                    <?php if (User::isLoggedIn()): ?>
                        <li class="nav-item"><a class="nav-link" href="index.php?page=dashboard">Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link" href="index.php?page=cart">Cart (<?php echo count($_SESSION['cart']); ?>)</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <?php echo $_SESSION['user_name']; ?>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-menu-item dropdown-item" href="index.php?page=profile">Profile</a></li>
                                <li><a class="dropdown-menu-item dropdown-item" href="index.php?page=orders">My Orders</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-menu-item dropdown-item text-danger" href="index.php?page=logout">Logout</a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="index.php?page=login">Login</a></li>
                        <li class="nav-item"><a class="btn btn-light ms-lg-2" href="index.php?page=signup">Sign Up</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
