<?php
$user_id = $_SESSION['user_id'];
$my_products = $productObj->getByUserId($user_id);
$received_orders = $orderObj->getReceivedOrders($user_id);
$my_orders = $orderObj->getByUserId($user_id);

include 'includes/header.php';
?>
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Seller Dashboard</h2>
        <a href="index.php?page=add_product" class="btn btn-primary">+ List New Product</a>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card p-4 shadow-sm bg-primary text-white">
                <h6>My Products</h6>
                <h3><?php echo count($my_products); ?></h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-4 shadow-sm bg-success text-white">
                <h6>Orders Received</h6>
                <h3><?php echo count($received_orders); ?></h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-4 shadow-sm bg-info text-white">
                <h6>My Purchases</h6>
                <h3><?php echo count($my_orders); ?></h3>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card p-4 shadow-sm">
                <h5 class="fw-bold mb-4">My Products</h5>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($my_products as $p): ?>
                            <tr>
                                <td><?php echo $p['name']; ?></td>
                                <td>$<?php echo number_format($p['price'], 2); ?></td>
                                <td>
                                    <a href="index.php?page=edit_product&id=<?php echo $p['id']; ?>" class="btn btn-sm btn-outline-secondary">Edit</a>
                                    <a href="api/delete_product.php?id=<?php echo $p['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php if (empty($my_products)): ?>
                                <tr><td colspan="3" class="text-center">No products listed yet.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card p-4 shadow-sm">
                <h5 class="fw-bold mb-4">Recent Orders Received</h5>
                <?php foreach (array_slice($received_orders, 0, 5) as $ro): ?>
                    <div class="border-bottom pb-3 mb-3">
                        <div class="d-flex justify-content-between">
                            <strong><?php echo $ro['product_name']; ?></strong>
                            <span class="text-success fw-bold">$<?php echo number_format($ro['item_price'], 2); ?></span>
                        </div>
                        <div class="small text-muted">Buyer: <?php echo $ro['buyer_name']; ?></div>
                        <div class="small text-muted">Qty: <?php echo $ro['quantity']; ?> | <?php echo date('M d, Y', strtotime($ro['created_at'])); ?></div>
                    </div>
                <?php endforeach; ?>
                <?php if (empty($received_orders)): ?>
                    <p class="text-center text-muted">No orders received yet.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>
