<?php
$user_id = $_SESSION['user_id'];
$user = $userObj->getById($user_id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'name' => $_POST['name']
    ];

    if ($userObj->update($user_id, $data)) {
        $_SESSION['user_name'] = $_POST['name'];
        header('Location: index.php?page=profile&updated=1');
        exit();
    }
}

include 'includes/header.php';
?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card p-4 shadow-sm">
                <h2 class="fw-bold mb-4">My Profile</h2>
                <?php if (isset($_GET['updated'])): ?>
                    <div class="alert alert-success">Profile updated successfully!</div>
                <?php endif; ?>
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $user['name']; ?>" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Email Address</label>
                        <input type="email" class="form-control" value="<?php echo $user['email']; ?>" disabled>
                        <small class="text-muted">Email cannot be changed.</small>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 py-2">Update Profile</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>
