<?php

require_once 'controller/interface/BaseController.php';
require_once 'controller/AuthController.php';
require_once 'model/UserModel.php';

class AuthController extends BaseController
{
    private $userModel;

    public function __construct($conn)
    {
        parent::__construct($this);

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

    public function handleRegistration()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $name = $_POST['name'];
            $password = $_POST['password'];

            if ($this->register($username, $name, $password)) {
                $this->redirectTo('dashboard');
            } else {
                echo "<div class='alert alert-danger'>Username is already taken. Please choose a different one.</div>";
            }
        }

        include 'View/auth/register.php';
    }

    public function handleLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);

            if ($this->login($username, $password)) {
                $_SESSION['loggedIn'] = true;
                $this->redirectTo('dashboard');
            } else {
                echo "<div class='alert alert-danger'>Invalid username or password.</div>";
            }
        }

        include 'View/auth/login.php';
    }

    public function displayDashboard()
    {
        if ($this->isLoggedIn()) {
            include 'View/dashboard.php';
        } else {
            $this->redirectTo('login');
        }
    }

    public function handleLogout()
    {
        $this->logout();
        $this->redirectTo('login');
    }


    private function logout()
    {
        session_destroy();
        setcookie('user_id', '', time() - 3600, '/');
        header('Location: /cookbook');
        exit();
    }

    private function register($username, $name, $password)
    {
        $existingUser = $this->userModel->getUserByUsername($username);

        if (!$existingUser) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $this->userModel->registerUser($username, $name, $hashedPassword);
            return true;
        } else {
            return false;
        }
    }

    private function login($username, $password)
    {
        $user = $this->userModel->getUserByUsername($username);

        if (!empty($user) && password_verify($password, $user['password'])) {
            setcookie('user_id', $user['id'], time() + (86400 * 30), "/"); // 86400 = 1 day
            return true;
        } else {
            return false;
        }
    }
}
