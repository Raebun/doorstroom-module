<?php
require_once 'config.php';

$conn = connectToDatabase();
$userController = new UserController($conn);
$user = $userController->getUserById();

$username = $user['username'];
$name = $user['name'];

$pageTitle = $name;
include __DIR__ . '/../templates/head.php';
?>

<div class="container mt-4">
    <form action="index.php?action=profile/edit" method="post">

        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control w-50" id="username" name="username" value="<?php echo $username; ?>" required>
        </div>

        <div class="form-group">
            <label for="name">Name</label>
            <input class="form-control w-50 w-md-100" id="name" name="name" value="<?php echo $name; ?>" required>
        </div>

        <button type="submit" class="btn btn-success">Update profile</button>
    </form>
</div>
<?php include __DIR__ . '/../templates/footer.php'; ?>
