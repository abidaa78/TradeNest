<?php
$id = $_GET['id'];
$user_id = $_SESSION['user_id'];
$product = $productObj->getById($id);

if (!$product || $product['user_id'] != $user_id) {
    header('Location: index.php?page=dashboard');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'name' => $_POST['name'],
        'price' => $_POST['price'],
        'description' => $_POST['description']
    ];
    
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $image_name = time() . '.' . $ext;
        if (move_uploaded_file($_FILES['image']['tmp_name'], UPLOAD_DIR . $image_name)) {
            $data['image'] = $image_name;
        }
    }

    if ($productObj->update($id, $user_id, $data)) {
        header('Location: index.php?page=dashboard&updated=1');
        exit();
    }
}
include 'includes/header.php';
?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card p-4 shadow-sm">
                <h2 class="fw-bold mb-4">Edit Product</h2>
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Product Name</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $product['name']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Price ($)</label>
                        <input type="number" name="price" class="form-control" step="0.01" value="<?php echo $product['price']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="5" required><?php echo $product['description']; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Product Image (Leave blank to keep current)</label>
                        <input type="file" name="image" class="form-control">
                        <?php if ($product['image']): ?>
                            <div class="mt-2 small text-muted">Current: <?php echo $product['image']; ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="mt-4 d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4">Update Product</button>
                        <a href="index.php?page=dashboard" class="btn btn-outline-secondary px-4">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>
