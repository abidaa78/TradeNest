<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $user_id = $_SESSION['user_id'];
    
    $image = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $image = time() . '.' . $ext;
        move_uploaded_file($_FILES['image']['tmp_name'], UPLOAD_DIR . $image);
    }

    if ($productObj->create($user_id, $name, $price, $description, $image)) {
        header('Location: index.php?page=dashboard');
        exit();
    }
}
include 'includes/header.php';
?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card p-4 shadow-sm">
                <h2 class="fw-bold mb-4">List New Product</h2>
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Product Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Price ($)</label>
                        <input type="number" name="price" class="form-control" step="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="5" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Product Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="mt-4 d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4">List Product</button>
                        <a href="index.php?page=dashboard" class="btn btn-outline-secondary px-4">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>
