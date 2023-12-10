<?php

require_once 'model/UserModel.php';
require_once 'controller/interface/BaseController.php';
require_once 'controller/AuthController.php';

class UserController extends BaseController
{
    private $userModel;

    public function __construct($conn)
    {
        $authController = new AuthController($conn);
        parent::__construct($authController);

        $this->userModel = new UserModel($conn);
    }

    public function isLoggedIn()
    {
        if (isset($_COOKIE['user_id'])) {
            $userId = $_COOKIE['user_id'];
            $user = $this->userModel->getUserById($userId);

            return !empty($user);
        }

        return false;
    }

    public function getUserById()
    {
        $userId = $_COOKIE['user_id'];
        return $this->userModel->getUserById($userId);
    }

    public function handleProfile()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->isLoggedIn()) {
                $userId = $_COOKIE['user_id'];
                $username = $_POST['username'];
                $name = $_POST['name'];

                if ($userId && is_numeric($userId)) {
                    try {
                        if ($this->userModel->updateProfile($userId, $username, $name)) {
                            $this->redirectTo('profile');
                        } else {
                            $errorMessage = "Failed to update profile.";
                            $this->redirectToError($errorMessage);
                        }
                    } catch (\PDOException $e) {
                        if ($e->getCode() == 23000) {
                            echo "<div class='alert-danger'>Username is already taken. Please choose a different one.</div>";
                        } else {
                            $errorMessage = "Database error: " . $e->getMessage();
                            $this->redirectToError($errorMessage);
                        }
                    }
                }
            } else {
                $this->redirectTo('login');
            }
        }

        include 'View/user/profile.php';
    }

}
