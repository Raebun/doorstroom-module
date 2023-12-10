<?php
require_once 'config.php';
$conn = connectToDatabase();
$ingredientController = new IngredientController($conn);
$ingredients = $ingredientController->getAllIngredients();

$pageTitle = "Manage Ingredients";
include __DIR__ . '/../templates/head.php';
?>

<div class="container mt-4">
    <div class="row mb-3">
        <div class="col">
            <a href="index.php?action=manage/ingredients/add" class="btn btn-outline-success">Add Ingredient</a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Unit</th>
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
                    <td><?php echo $ingredient['unit']; ?></td>
                    <td>
                        <div class="btn-group" role="group">
                            <a href="index.php?action=manage/ingredients/delete&id=<?php echo $ingredient['ingredientId']; ?>" class="btn btn-custom-main-outline">Delete</a>
                        </div>
                    </td>
                </tr>
                <?php $ingredientCounter++; ?>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php include __DIR__ . '/../templates/footer.php'; ?>
