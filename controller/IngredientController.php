<?php

require_once 'model/IngredientModel.php';
require_once 'controller/interface/BaseController.php';
require_once 'controller/AuthController.php';

class IngredientController extends BaseController
{
    private $ingredientModel;

    public function __construct($conn)
    {
        $authController = new AuthController($conn);
        parent::__construct($authController);

        $this->ingredientModel = new IngredientModel($conn);
    }

    public function getAllIngredients()
    {
        return $this->ingredientModel->getAllIngredients();
    }

    public function displayIngredients()
    {
        if ($this->isLoggedIn()) {
            include 'View/ingredient/ingredients.php';
        } else {
            $this->redirectTo('login');
        }
    }

    public function handleIngredients()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->isLoggedIn()) {
                $name = $_POST['name'];
                $unit = $_POST['unit'];
                if ($this->ingredientModel->addIngredient($name, $unit)) {
                    $this->redirectTo('manage/ingredients');
                } else {
                    $errorMessage = "Failed to add ingredient.";
                    $this->redirectToError($errorMessage);
                }
            } else {
                $this->redirectTo('login');
            }
        }

        include 'View/ingredient/addIngredient.php';
    }

    public function deleteIngredient()
    {
        if ($this->isLoggedIn()) {
            $ingredientId = isset($_GET['id']) ? $_GET['id'] : null;

            if ($ingredientId && is_numeric($ingredientId)) {
                $deleteRecipe = $this->ingredientModel->deleteIngredient($ingredientId);

                if ($deleteRecipe) {
                    $this->redirectTo('manage/ingredients');
                    exit;
                }
            }

            $errorMessage = "Failed to delete ingredient.";
            $this->redirectToError($errorMessage);
        } else {
            $this->redirectTo('login');
        }
    }
}
