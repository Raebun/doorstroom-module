<?php

class UserModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getUserById($userId)
    {
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $userId);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function registerUser($username, $name, $password)
    {
        $sql =
            'INSERT INTO  Users
            (
                Username,
                Name,
                Password
            )
            VALUES (?, ?, ?)';

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$username, $name, $password]);
    }

    public function getUserByUsername($username)
    {
        $sql =
            'SELECT
                *
            FROM
                users
            WHERE
                Username = ?';

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateProfile($userId, $username, $name)
    {
        $sql =
            'UPDATE users
            SET
                username = ?,
                name = ?
            WHERE
                id = ?';

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$username, $name, $userId, ]);
    }
}
