<?php
require_once 'config.php';
$conn = connectToDatabase();
$recipeController = new RecipeController($conn);
$recipeId = $recipe['recipeId'];
$ingredients = $recipeController->getIngredientsByRecipeId($recipeId);

$pageTitle = $recipe['title'];
include __DIR__ . '/../templates/head.php';
?>

<div class="container mt-4">

    <div class="row mb-3">
        <div class="col">
            <h3>Description</h3>
            <p>
                <?php echo $recipe['description']; ?>
            </p>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col">
            <h3>Portion</h3>
            <p>
                <?php echo $recipe['portion']; ?>
            </p>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col">
            <h3>Ingredients</h3>
            <a href="index.php?action=ingredientRecipe/add&recipeId=<?php echo $recipe['recipeId'] ?>" class="btn btn-outline-success">Add Ingredient</a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Ingredient</th>
                <th scope="col">Quantity</th>
                <th scope="col">Amount</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <?php
            $ingredientCounter = 0;
            foreach ($ingredients as $ingredient): ?>
                <tr>
                    <th scope="row"><?php echo $ingredientCounter; ?></th>
                    <td><?php echo $ingredient['name']; ?></td>
                    <td><?php echo $ingredient['quantity']; ?></td>
                    <td><?php echo $ingredient['unitAmount'] . ' ' . $ingredient['unit']; ?></td>
                    <td>
                        <form method="post" action="index.php?action=ingredientRecipe/delete">
                            <input type="hidden" name="recipeId" value="<?php echo $recipe['recipeId']; ?>">
                            <input type="hidden" name="id" value="<?php echo $ingredient['recipeIngredientId']; ?>">
                            <button type="submit" class="btn btn-custom-main-outline">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php $ingredientCounter++; ?>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php include __DIR__ . '/../templates/footer.php'; ?>
