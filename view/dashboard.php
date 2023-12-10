<?php
require_once 'config.php';
$conn = connectToDatabase();
$recipeController = new RecipeController($conn);
$recipes = $recipeController->getRecipesByUserId();

$pageTitle = "Recipes";
include 'templates/head.php';
?>

<div class="container mt-4">
    <div class="row mb-3">
        <div class="col">
            <a href="index.php?action=recipe/add" class="btn btn-outline-success">Add Recipe</a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Portions</th>
                <th scope="col">Description</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <?php
            $recipeCounter = 0;
            foreach ($recipes as $recipe): ?>
                <tr>
                    <th scope="row"><?php echo $recipeCounter; ?></th>
                    <td><?php echo $recipe['title']; ?></td>
                    <td><?php echo $recipe['portion']; ?></td>
                    <td><?php echo $recipe['description']; ?></td>
                    <td>
                        <div class="btn-group" role="group">
                            <a href="index.php?action=recipe&id=<?php echo $recipe['recipeId']; ?>" class="btn btn-custom-main-outline">View</a>
                            <a href="index.php?action=recipe/edit&id=<?php echo $recipe['recipeId']; ?>" class="btn btn-custom-main-outline">Edit</a>
                            <a href="index.php?action=recipe/delete&id=<?php echo $recipe['recipeId']; ?>" class="btn btn-custom-main-outline">Delete</a>
                        </div>
                    </td>
                </tr>
                <?php $recipeCounter++; ?>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php include('templates/footer.php'); ?>
