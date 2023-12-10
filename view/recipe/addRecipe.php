<?php
require_once 'config.php';

$pageTitle = isset($_GET['action']) && $_GET['action'] == 'recipe/edit' ? 'Edit Recipe' : 'Add Recipe';
include __DIR__ . '/../templates/head.php';

$title = '';
$portion = '';
$description = '';

if (isset($_GET['action']) && $_GET['action'] == 'recipe/edit' && isset($_GET['id'])) {
    $recipeId = $_GET['id'];
    $conn = connectToDatabase();
    $recipeController = new RecipeController($conn);
    $recipe = $recipeController->getRecipeById($recipeId);

    $title = $recipe['title'];
    $portion = $recipe['portion'];
    $description = $recipe['description'];
}
?>

<div class="container mt-4">
    <form action="<?php echo isset($_GET['action']) && $_GET['action'] == 'recipe/edit' ? 'index.php?action=recipe/edit&id=' . $recipeId : 'index.php?action=recipe/add'; ?>" method="post">
        <?php if (isset($_GET['action']) && $_GET['action'] == 'recipe/edit'): ?>
            <input type="hidden" name="recipe_id" value="<?php echo $recipeId; ?>">
        <?php endif; ?>

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control w-50" id="title" name="title" placeholder="Recipe name" required value="<?php echo $title; ?>">
        </div>

        <div class="form-group">
            <label for="portion">Portion</label>
            <input type="number" class="form-control w-50" id="portion" name="portion" placeholder="Portion" required value="<?php echo $portion; ?>">
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" placeholder="Write a description" required><?php echo $description; ?></textarea>
        </div>

        <button type="submit" class="btn btn-success"><?php echo isset($_GET['action']) && $_GET['action'] == 'recipe/edit' ? 'Update recipe' : 'Add recipe'; ?></button>
    </form>
</div>
<?php include __DIR__ . '/../templates/footer.php'; ?>
