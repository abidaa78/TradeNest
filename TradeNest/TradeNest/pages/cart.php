<?php
if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    unset($_SESSION['cart'][$remove_id]);
    header('Location: index.php?page=cart');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['place_order'])) {
    $user_id = $_SESSION['user_id'];
    $total_amount = 0;
    $items = [];
    
    foreach ($_SESSION['cart'] as $item) {
        $total_amount += $item['price'] * $item['quantity'];
        $items[] = [
            'product_id' => $item['id'],
            'quantity' => $item['quantity'],
            'price' => $item['price']
        ];
    }

    if ($orderObj->place($user_id, $total_amount, $items)) {
        $_SESSION['cart'] = [];
        header('Location: index.php?page=orders&success=1');
        exit();
    }
}

include 'includes/header.php';
?>
<div class="container py-5">
    <h2 class="fw-bold mb-4">Shopping Cart</h2>
    
    <?php if (empty($_SESSION['cart'])): ?>
        <div class="card p-5 text-center shadow-sm">
            <h4 class="text-muted mb-4">Your cart is empty</h4>
            <a href="index.php?page=product_list" class="btn btn-primary px-5">Continue Shopping</a>
        </div>
    <?php else: ?>
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card p-4 shadow-sm">
                    <?php 
                    $total = 0;
                    foreach ($_SESSION['cart'] as $id => $item): 
                        $subtotal = $item['price'] * $item['quantity'];
                        $total += $subtotal;
                    ?>
                    <div class="d-flex align-items-center mb-4 pb-4 border-bottom">
                        <div style="width: 100px;">
                            <?php if ($item['image']): ?>
                                <img src="assets/uploads/<?php echo $item['image']; ?>" class="img-fluid rounded" alt="">
                            <?php endif; ?>
                        </div>
                        <div class="ms-4 flex-grow-1">
                            <h5 class="fw-bold m-0"><?php echo $item['name']; ?></h5>
                            <div class="text-muted small">Price: $<?php echo number_format($item['price'], 2); ?></div>
                        </div>
                        <div class="text-center px-3" style="width: 100px;">
                            <div class="small text-muted">Qty</div>
                            <div class="fw-bold"><?php echo $item['quantity']; ?></div>
                        </div>
                        <div class="text-end" style="width: 120px;">
                            <div class="fw-bold text-primary">$<?php echo number_format($subtotal, 2); ?></div>
                            <a href="index.php?page=cart&remove=<?php echo $id; ?>" class="text-danger small text-decoration-none">Remove</a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card p-4 shadow-sm">
                    <h5 class="fw-bold mb-4">Order Summary</h5>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Items (<?php echo count($_SESSION['cart']); ?>)</span>
                        <span>$<?php echo number_format($total, 2); ?></span>
                    </div>
                    <div class="d-flex justify-content-between mb-4 h4 fw-bold">
                        <span>Total</span>
                        <span>$<?php echo number_format($total, 2); ?></span>
                    </div>
                    <form method="POST">
                        <button type="submit" name="place_order" class="btn btn-primary w-100 py-3">Confirm & Place Order</button>
                    </form>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php include 'includes/footer.php'; ?>
