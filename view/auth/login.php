<?php
$pageTitle = "Login";
include __DIR__ . '/../templates/head.php';
?>
<div class="container">
    <h1 class="mt-5">Login</h1>
    <form action="index.php?action=login" method="post">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <button type="submit" class="btn btn-primary">Login</button>
    </form>

    <p class="mt-3">Don't have an account? <a href="index.php?action=register" class="btn btn-link">Register</a></p>
</div>

<?php include __DIR__ . '/../templates/footer.php'; ?>
