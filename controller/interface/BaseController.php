<?php

class BaseController
{
    protected $authController;

    public function __construct(AuthController $authController)
    {
        $this->authController = $authController;
    }

    protected function isLoggedIn()
    {
        return $this->authController->isLoggedIn();
    }

    protected function redirectTo($page, $params = [])
    {
        $baseUrl = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
        $baseUrl .= "://" . $_SERVER['HTTP_HOST'] . "/cookbook/";
        $url = "{$baseUrl}index.php?action=$page";

        if (!empty($params)) {
            $url .= '&' . http_build_query($params);
        }

        header("Location: $url");
        exit();
    }

    protected function redirectToError($errorMessage)
    {
        $error = $errorMessage;
        include 'view/status/error.php';
        exit();
    }
}