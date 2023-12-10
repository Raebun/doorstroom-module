<?php

require_once 'model/RecipeModel.php';
require_once 'controller/interface/BaseController.php';
require_once 'controller/AuthController.php';
class RecipeController extends BaseController
{
    private $recipeModel;

    public function __construct($conn)
    {
        $authController = new AuthController($conn);
        parent::__construct($authController);

        $this->recipeModel = new RecipeModel($conn);
    }

    public function handleRecipe()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->isLoggedIn()) {
                $userId = $_COOKIE['user_id'];
                $title = $_POST['title'];
                $description = $_POST['description'];
                $portion = $_POST['portion'];

                $recipeId = isset($_GET['id']) ? $_GET['id'] : null;

                if ($recipeId && is_numeric($recipeId)) {
                    if ($this->recipeModel->updateRecipe($recipeId, $userId, $title, $description, $portion)) {
                        $this->redirectTo('dashboard');
                    } else {
                        $errorMessage = "Failed to update recipe.";
                        $this->redirectToError($errorMessage);
                    }
                } else {
                    if ($this->recipeModel->insertRecipe($userId, $title, $description, $portion)) {
                        $this->redirectTo('dashboard');
                    } else {
                        $errorMessage = "Failed to add recipe.";
                        $this->redirectToError($errorMessage);
                    }
                }
            } else {
                $this->redirectTo('login');
            }
        }

        include 'View/recipe/addRecipe.php';
    }

    public function deleteRecipe()
    {
        if ($this->isLoggedIn()) {
            $recipeId = isset($_GET['id']) ? $_GET['id'] : null;

            if ($recipeId && is_numeric($recipeId)) {
                $deleteRecipe = $this->recipeModel->deleteRecipe($recipeId);

                if ($deleteRecipe) {
                    $this->redirectTo('dashboard');
                    exit;
                }
            }

            $errorMessage = "Failed to delete recipe.";
            $this->redirectToError($errorMessage);
        } else {
            $this->redirectTo('login');
        }
    }

    public function getRecipesByUserId()
    {
        $userId = $_COOKIE['user_id'];
        return $this->recipeModel->getRecipesByUserId($userId);
    }

    public function displayRecipe()
    {
        if ($this->isLoggedIn()) {
            $recipeId = isset($_GET['id']) ? $_GET['id'] : null;

            if ($recipeId && is_numeric($recipeId)) {
                $recipe = $this->recipeModel->getRecipeById($recipeId);

                if ($recipe) {
                    include 'View/recipe/recipeDetail.php';
                    return;
                }
            }

            $errorMessage = "Recipe not found.";
            $this->redirectToError($errorMessage);
        } else {
            $this->redirectTo('login');
        }
    }

    public function getRecipeById($recipeId) {
        return $this->recipeModel->getRecipeById($recipeId);
    }

    public function getIngredientsByRecipeId($recipeId)
    {
        return $this->recipeModel->getIngredientsByRecipeId($recipeId);
    }
}
