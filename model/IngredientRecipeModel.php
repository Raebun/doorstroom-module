<?php

class IngredientRecipeModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function deleteIngredientRecipe($recipeIngredient)
    {
        $sql = 'DELETE FROM recipeIngredient WHERE recipeIngredientId = :recipeIngredientId';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':recipeIngredientId', $recipeIngredient);

        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function addIngredientToRecipe($recipeId, $ingredientId, $quantity, $amount) {

            $sql =
                'INSERT INTO recipeIngredient
                (
                    recipeId,
                    ingredientId,
                    quantity,
                    unitAmount
                )
                VALUES (?, ?, ?, ?)';

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$recipeId, $ingredientId, $quantity, $amount]);
    }
}
