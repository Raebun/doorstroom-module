<?php

require_once 'model/IngredientRecipeModel.php';
require_once 'controller/interface/BaseController.php';
require_once 'controller/AuthController.php';

class IngredientRecipeController extends BaseController
{
    private $ingredientRecipeModel;

    public function __construct($conn)
    {
        $authController = new AuthController($conn);
        parent::__construct($authController);

        $this->ingredientRecipeModel = new IngredientRecipeModel($conn);
    }

    public function deleteIngredientRecipe()
    {
        if ($this->isLoggedIn()) {
            $recipeId = isset($_POST['recipeId']) ? $_POST['recipeId'] : null;
            $ingredientRecipeId = isset($_POST['id']) ? $_POST['id'] : null;

            if ($ingredientRecipeId && is_numeric($ingredientRecipeId)) {
                $deleteIngredientRecipe = $this->ingredientRecipeModel->deleteIngredientRecipe($ingredientRecipeId);

                if ($deleteIngredientRecipe) {
                    $this->redirectTo('recipe', ['id' => $recipeId]);
                    exit;
                }
            }

            $errorMessage = "Failed to delete recipe.";
            $this->redirectToError($errorMessage);
        } else {
            $this->redirectTo('login');
        }
    }

    public function handleIngredientRecipe()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->isLoggedIn()) {
                $recipeId = $_POST['recipeId'];
                $ingredientId = $_POST['ingredientId'];
                $quantity = $_POST['quantity'];
                $amount = $_POST['amount'];

                if ($this->ingredientRecipeModel->addIngredientToRecipe($recipeId, $ingredientId, $quantity, $amount)) {
                    $this->redirectTo('recipe', ['id' => $recipeId]);
                } else {
                    $errorMessage = "Failed to add ingredient.";
                    $this->redirectToError($errorMessage);
                }
            } else {
                $this->redirectTo('login');
            }
        }

        include 'View/recipe/ingredient/addIngredientRecipe.php';
    }
}
