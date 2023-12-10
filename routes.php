<?php

class Route
{
    private $authController;
    private $userController;
    private $recipeController;
    private $ingredientController;
    private $ingredientRecipeController;
    private $validActions = [
        'register',
        'login',
        'logout',
        'dashboard',
        'profile',
        'profile/edit',
        'recipe',
        'recipe/add',
        'recipe/edit',
        'recipe/delete',
        'ingredientRecipe/add',
        'ingredientRecipe/delete',
        'manage/ingredients',
        'manage/ingredients/add',
        'manage/ingredients/delete',
    ];

    public function __construct(
        AuthController $authController,
        UserController $userController,
        RecipeController $recipeController,
        IngredientController $ingredientController,
        IngredientRecipeController $ingredientRecipeController
    )
    {
        $this->authController = $authController;
        $this->userController = $userController;
        $this->recipeController = $recipeController;
        $this->ingredientController = $ingredientController;
        $this->ingredientRecipeController = $ingredientRecipeController;
    }

    public function handleRequest($action)
    {
        if (!in_array($action, $this->validActions)) {
            $this->displayInvalidAction();
            return;
        }

        switch ($action) {
            case 'register':
                $this->authController->handleRegistration();
                break;

            case 'login':
                $this->authController->handleLogin();
                break;

            case 'logout':
                $this->authController->handleLogout();
                break;

            case 'dashboard':
                $this->authController->displayDashboard();
                break;

            case 'profile':
            case 'profile/edit':
                $this->userController->handleProfile();
                break;

            case 'recipe':
                $this->recipeController->displayRecipe();
                break;

            case 'recipe/edit':
            case 'recipe/add':
                $this->recipeController->handleRecipe();
                break;

            case 'recipe/delete':
                $this->recipeController->deleteRecipe();
                break;

            case 'ingredientRecipe/add':
                $this->ingredientRecipeController->handleIngredientRecipe();
                break;

            case 'ingredientRecipe/delete':
                $this->ingredientRecipeController->deleteIngredientRecipe();
                break;

            case 'manage/ingredients':
                $this->ingredientController->displayIngredients();
                break;

            case 'manage/ingredients/add':
                $this->ingredientController->handleIngredients();
                break;

            case 'manage/ingredients/delete':
                $this->ingredientController->deleteIngredient();
                break;

            default:
                $this->displayInvalidAction();
        }
    }

    private function displayInvalidAction()
    {
        $errorMessage = "Invalid action.";
        $this->redirectToError($errorMessage);
    }

    private function redirectToError($errorMessage)
    {
        $error = $errorMessage;
        include 'view/status/error.php';
        exit();
    }
}
