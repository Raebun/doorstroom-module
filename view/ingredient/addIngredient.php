<?php
require_once 'config.php';
$conn = connectToDatabase();
$ingredientController = new IngredientController($conn);
$ingredients = $ingredientController->getAllIngredients();
$recipeId = isset($_GET['recipeId']) ? $_GET['recipeId'] : null;

$pageTitle = 'Add Ingredient';
include __DIR__ . '/../templates/head.php';
?>

<div class="container mt-4">
    <form action="index.php?action=manage/ingredients/add" method="post">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control w-50" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="unit">Unit</label>
            <select class="form-control w-50" name="unit" id="unit" required>
                <option value="">-- Kies een optie --</option>
                <option value="grams">gram</option>
                <option value="ml">ml</option>
                <option value="ml">tsp</option>
                <option value="ml">tbsp</option>
            </select>
        </div>

        <input type="hidden" name="recipeId" value="<?php echo $recipeId; ?>">
        <button type="submit" class="btn btn-success">Add ingredient</button>
    </form>
</div>
<?php include __DIR__ . '/../templates/footer.php'; ?>
