<?php
$id = $_GET['id'];
$product = $productObj->getById($id);

if (!$product) {
    header('Location: index.php?page=404');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    if (!User::isLoggedIn()) {
        header('Location: index.php?page=login');
        exit();
    }
    
    $qty = $_POST['quantity'];
    $_SESSION['cart'][$id] = [
        'id' => $id,
        'name' => $product['name'],
        'price' => $product['price'],
        'quantity' => $qty,
        'image' => $product['image']
    ];
    header('Location: index.php?page=cart');
    exit();
}

include 'includes/header.php';
?>
<div class="container py-5">
    <div class="row g-5">
        <div class="col-md-6">
            <?php if ($product['image']): ?>
                <img src="assets/uploads/<?php echo $product['image']; ?>" class="img-fluid rounded-4 shadow" alt="<?php echo $product['name']; ?>">
            <?php else: ?>
                <div class="bg-light d-flex align-items-center justify-content-center rounded-4" style="height: 400px;">No Image</div>
            <?php endif; ?>
        </div>
        <div class="col-md-6">
            <h1 class="fw-bold mb-3"><?php echo $product['name']; ?></h1>
            <div class="h3 text-primary fw-bold mb-4">$<?php echo number_format($product['price'], 2); ?></div>
            
            <div class="mb-4">
                <h5 class="fw-bold">Description</h5>
                <p class="text-muted"><?php echo nl2br($product['description']); ?></p>
            </div>

            <div class="mb-4 p-3 bg-light rounded">
                <div class="small text-muted">Sold by</div>
                <div class="fw-bold"><?php echo $product['seller_name']; ?></div>
            </div>

            <form method="POST" class="d-flex gap-3 align-items-center">
                <div style="width: 100px;">
                    <label class="small text-muted">Quantity</label>
                    <input type="number" name="quantity" class="form-control" value="1" min="1">
                </div>
                <div class="flex-grow-1 pt-4">
                    <button type="submit" name="add_to_cart" class="btn btn-primary btn-lg w-100 py-3">Add to Cart</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>
