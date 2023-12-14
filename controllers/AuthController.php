<?php
include_once('UsersController.php');

class AuthController {
    private $userController;

    public function __construct() {
        $this->userController = new UsersController();
    }

    public function checkAuthentication($allowedRoles = []) {
        session_start();

        if (!$this->userController->isLoggedIn()) {
            header("Location: login.php");
            exit();
        }

        if (!empty($allowedRoles)) {
            $userRole = $_SESSION['user_role'];
            if (!in_array($userRole, $allowedRoles)) {
                header("Location: unauthorized.php");
                exit();
            }
        }
    }

    public function redirectToIndexIfLoggedIn() {
        if ($this->userController->isLoggedIn()) {
            $userRole = $_SESSION['user_role'];
            if ($userRole === 'admin') {
                header("Location: admin.php");
                exit();
            } else {
                header("Location: index.php");
                exit();
            }
        }
    }    
}
?>
