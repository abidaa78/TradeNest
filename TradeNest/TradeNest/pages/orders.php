<?php
$user_id = $_SESSION['user_id'];
$orders = $orderObj->getByUserId($user_id);

include 'includes/header.php';
?>
<div class="container py-5">
    <h2 class="fw-bold mb-4">My Orders</h2>
    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show mb-4">
            Order placed successfully! Thank you for shopping with TradeNest.
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
    <?php endif; ?>

    <div class="card p-4 shadow-sm">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                    <tr>
                        <td>#<?php echo str_pad($order['id'], 5, '0', STR_PAD_LEFT); ?></td>
                        <td><?php echo date('M d, Y', strtotime($order['created_at'])); ?></td>
                        <td class="fw-bold text-primary">$<?php echo number_format($order['total_amount'], 2); ?></td>
                        <td>
                            <span class="badge bg-<?php echo $order['status'] == 'Completed' ? 'success' : 'warning'; ?>">
                                <?php echo $order['status']; ?>
                            </span>
                        </td>
                        <td>
                            <a href="index.php?page=order_detail&id=<?php echo $order['id']; ?>" class="btn btn-sm btn-outline-primary">Details</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($orders)): ?>
                        <tr><td colspan="5" class="text-center py-4 text-muted">You haven't placed any orders yet.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>
