<?php
require_once 'config.php';
$conn = connectToDatabase();
$ingredientController = new IngredientController($conn);
$ingredients = $ingredientController->getAllIngredients();
$recipeId = isset($_GET['recipeId']) ? $_GET['recipeId'] : null;

$pageTitle = 'Add Ingredient';
include __DIR__ . '/../../templates/head.php';
?>

<div class="container mt-4">
    <form action="index.php?action=ingredientRecipe/add" method="post">
        <div class="form-group">
            <label for="ingredientId">Ingredient</label>
            <select class="form-control w-50" name="ingredientId" id="ingredientId" required>
                <option value="">-- Kies een optie --</option>
                <?php foreach ($ingredients as $ingredient): ?>
                <option value="<?php echo $ingredient["ingredientId"] ?>">
                    <?php echo $ingredient["name"] . ' (' . $ingredient["unit"] . ')' ?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" class="form-control w-50" id="quantity" name="quantity" required>
        </div>

        <div class="form-group">
            <label for="amount">Unit amount</label>
            <input type="number" class="form-control w-50" id="amount" name="amount" required>
        </div>

        <input type="hidden" name="recipeId" value="<?php echo $recipeId; ?>">
        <button type="submit" class="btn btn-success">Add ingredient</button>
    </form>
</div>
<?php include __DIR__ . '/../../templates/footer.php'; ?>
