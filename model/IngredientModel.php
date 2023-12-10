<?php

class IngredientModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getAllIngredients()
    {
        $sql = "SELECT * FROM ingredients";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addIngredient($name, $unit) {

        $sql =
            'INSERT INTO ingredients
                (
                    name,
                    unit
                )
            VALUES (?, ?)';

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$name, $unit]);
    }

    public function deleteIngredient($ingredientId)
    {
        $sql = 'DELETE FROM ingredients WHERE ingredientId = :ingredientId';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':ingredientId', $ingredientId);

        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}
