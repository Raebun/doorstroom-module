<?php
$pageTitle = "Register";
include __DIR__ . '/../templates/head.php';
?>

<div class="container">
    <h1 class="mt-5">Register</h1>
    <form action="index.php?action=register" method="post">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>

<?php include __DIR__ . '/../templates/footer.php'; ?>
