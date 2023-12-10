<?php
require_once 'config.php';
$conn = connectToDatabase();
$userController = new UserController($conn);
$user = $userController->getUserById();
?>
<nav class="navbar navbar-expand-lg navbar-light navbar-custom">
    <div class="container-fluid">

        <a class="navbar-brand text-white font-weight-bold" href="index.php?action=dashboard">Cookbook</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php?action=profile">Profile <span class="sr-only"></span></a>
                </li>
                <?php if ($user['role'] === 0) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?action=manage/ingredients">Manage Ingredients <span class="sr-only"></span></a>
                </li>
                <?php } ?>
            </ul>

            <form action="index.php?action=logout" method="post" class="ml-auto">
                <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Logout</button>
            </form>
        </div>
    </div>
</nav>
