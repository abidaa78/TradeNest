<?php include 'includes/header.php'; ?>

<header class="hero-section text-center">
    <div class="container">
        <h1 class="display-3 fw-bold mb-3">Welcome to <?php echo APP_NAME; ?></h1>
        <p class="lead mb-5">Your local marketplace to buy and sell anything, anytime.</p>
        <div class="d-flex justify-content-center gap-3">
            <a href="index.php?page=product_list" class="btn btn-light btn-lg px-5">Explore Products</a>
            <?php if (!User::isLoggedIn()): ?>
                <a href="index.php?page=signup" class="btn btn-outline-light btn-lg px-5">Start Selling</a>
            <?php endif; ?>
        </div>
    </div>
</header>

<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-5 fw-bold">Recent Listings</h2>
        <div class="row g-4">
            <?php 
            $recent_products = array_slice($productObj->getAll(), 0, 4);
            foreach ($recent_products as $product): 
            ?>
            <div class="col-md-3">
                <div class="card h-100 shadow-sm">
                    <?php if ($product['image']): ?>
                        <img src="assets/uploads/<?php echo $product['image']; ?>" class="card-img-top product-img" alt="<?php echo $product['name']; ?>">
                    <?php else: ?>
                        <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">No Image</div>
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title fw-bold"><?php echo $product['name']; ?></h5>
                        <p class="text-primary fw-bold h5 mb-3">$<?php echo number_format($product['price'], 2); ?></p>
                        <p class="card-text text-muted small"><?php echo substr($product['description'], 0, 60); ?>...</p>
                        <a href="index.php?page=product_detail&id=<?php echo $product['id']; ?>" class="btn btn-outline-primary w-100">View Details</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <?php if (empty($recent_products)): ?>
                <p class="text-center text-muted">No products listed yet.</p>
            <?php endif; ?>
        </div>
        <div class="text-center mt-5">
            <a href="index.php?page=product_list" class="btn btn-primary px-5">View All Products</a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
