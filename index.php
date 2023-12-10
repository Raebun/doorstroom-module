<?php
require_once 'config.php';
require_once 'Controller/UserController.php';
require_once 'Controller/RecipeController.php';
require_once 'Controller/IngredientController.php';
require_once 'Controller/IngredientRecipeController.php';
require_once 'routes.php';

session_start();

$action = isset($_GET['action']) ? $_GET['action'] : 'login';

$conn = connectToDatabase();
$authController = new AuthController($conn);
$userController = new UserController($conn);
$recipeController = new RecipeController($conn);
$ingredientController = new IngredientController($conn);
$ingredientRecipeController = new IngredientRecipeController($conn);

$route = new Route($authController, $userController, $recipeController, $ingredientController, $ingredientRecipeController);
$route->handleRequest($action);
