<?php
$id = $_GET['id'];
$user_id = $_SESSION['user_id'];
$order = $orderObj->getById($id, $user_id);

if (!$order) {
    header('Location: index.php?page=orders');
    exit();
}

include 'includes/header.php';
?>
<div class="container py-5">
    <div class="mb-4">
        <a href="index.php?page=orders" class="text-decoration-none small">← Back to Orders</a>
        <h2 class="fw-bold mt-2">Order Details #<?php echo str_pad($order['id'], 5, '0', STR_PAD_LEFT); ?></h2>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card p-4 shadow-sm mb-4">
                <h5 class="fw-bold mb-4">Items Ordered</h5>
                <?php foreach ($order['items'] as $item): ?>
                    <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                        <div>
                            <div class="fw-bold"><?php echo $item['name']; ?></div>
                            <div class="text-muted small">Qty: <?php echo $item['quantity']; ?> x $<?php echo number_format($item['price'], 2); ?></div>
                        </div>
                        <div class="fw-bold">$<?php echo number_format($item['quantity'] * $item['price'], 2); ?></div>
                    </div>
                <?php endforeach; ?>
                <div class="d-flex justify-content-between mt-3 h4 fw-bold">
                    <span>Total Amount</span>
                    <span class="text-primary">$<?php echo number_format($order['total_amount'], 2); ?></span>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card p-4 shadow-sm">
                <h5 class="fw-bold mb-3">Order Status</h5>
                <div class="p-3 bg-light rounded text-center">
                    <span class="badge bg-<?php echo $order['status'] == 'Completed' ? 'success' : 'warning'; ?> fs-6">
                        <?php echo $order['status']; ?>
                    </span>
                    <div class="mt-2 small text-muted">Placed on <?php echo date('M d, Y', strtotime($order['created_at'])); ?></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>
