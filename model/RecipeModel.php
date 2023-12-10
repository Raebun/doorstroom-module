<?php

class RecipeModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function insertRecipe($userId, $title, $description, $portion)
    {
        $sql =
            'INSERT INTO recipes
            (
                userId,
                title,
                description,
                `portion`
            )
            VALUES (?, ?, ?, ?)';

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$userId, $title, $description, $portion]);
    }

    public function updateRecipe($recipeId, $userId, $title, $description, $portion)
    {
        $sql =
            'UPDATE recipes
            SET
                userId = ?,
                title = ?,
                description = ?,
                `portion` = ?
            WHERE
                recipeId = ?';

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$userId, $title, $description, $portion, $recipeId]);
    }

    public function deleteRecipe($recipeId)
    {
        try {
            $this->conn->beginTransaction();

            $sql = 'DELETE FROM recipeIngredient WHERE recipeId = :recipeId';
            $stmtRecipeIngredient = $this->conn->prepare($sql);
            $stmtRecipeIngredient->bindParam(':recipeId', $recipeId);
            $stmtRecipeIngredient->execute();

            $sql = 'DELETE FROM recipes WHERE recipeId = :recipeId';
            $stmtRecipe = $this->conn->prepare($sql);
            $stmtRecipe->bindParam(':recipeId', $recipeId);
            $stmtRecipe->execute();

            $this->conn->commit();

            return true;
        } catch (Exception $e) {
            $this->conn->rollBack();
            return false;
        }
    }

    public function getRecipesByUserId($userId)
    {
        $sql = "SELECT * FROM recipes WHERE userId = :userId";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRecipeById($recipeId)
    {
        $sql = "SELECT * FROM recipes WHERE recipeId = :recipeId";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':recipeId', $recipeId);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getIngredientsByRecipeId($recipeId)
    {
        $sql =
            "SELECT 
                * 
            FROM 
                recipeIngredient
            JOIN ingredients
                ON recipeIngredient.ingredientId = ingredients.ingredientId
            WHERE 
                recipeId = :recipeId";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':recipeId', $recipeId);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
