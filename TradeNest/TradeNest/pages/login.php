<?php
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($userObj->login($email, $password)) {
        header('Location: index.php?page=dashboard');
        exit();
    } else {
        $error = "Invalid email or password.";
    }
}
include 'includes/header.php';
?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card p-4 shadow-sm">
                <h2 class="text-center mb-4 fw-bold">Login</h2>
                <?php if (isset($_GET['registered'])): ?>
                    <div class="alert alert-success">Registration successful. Please login.</div>
                <?php endif; ?>
                <?php if ($error): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 py-2">Login</button>
                </form>
                <p class="text-center mt-3">Don't have an account? <a href="index.php?page=signup">Sign Up</a></p>
            </div>
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>
