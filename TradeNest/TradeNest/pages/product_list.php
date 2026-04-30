<?php
$query = isset($_GET['q']) ? $_GET['q'] : '';
if ($query) {
    $products = $productObj->search($query);
} else {
    $products = $productObj->getAll();
}

include 'includes/header.php';
?>
<div class="container py-5">
    <div class="row mb-5 align-items-center">
        <div class="col-md-6">
            <h2 class="fw-bold m-0">Explore Marketplace</h2>
        </div>
        <div class="col-md-6">
            <form class="d-flex" action="index.php">
                <input type="hidden" name="page" value="product_list">
                <input type="text" name="q" class="form-control me-2" placeholder="Search products..." value="<?php echo $query; ?>">
                <button class="btn btn-primary" type="submit">Search</button>
            </form>
        </div>
    </div>

    <div class="row g-4">
        <?php foreach ($products as $product): ?>
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
                    <div class="small text-muted mb-3">Seller: <?php echo $product['seller_name']; ?></div>
                    <a href="index.php?page=product_detail&id=<?php echo $product['id']; ?>" class="btn btn-outline-primary w-100">View Details</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <?php if (empty($products)): ?>
            <div class="col-12 text-center py-5">
                <p class="text-muted h4">No products found for "<?php echo $query; ?>"</p>
                <a href="index.php?page=product_list" class="btn btn-link">View All Products</a>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php include 'includes/footer.php'; ?>
