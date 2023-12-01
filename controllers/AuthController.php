<?php
include_once('UsersController.php');

class AuthController {
    private $userController;

    public function __construct() {
        $this->userController = new UsersController();
    }

    public function checkAuthentication($allowedRoles = []) {
        session_start();

        // If not logged in, redirect to login.php
        if (!$this->userController->isLoggedIn()) {
            header("Location: login.php");
            exit();
        }

        // If allowedRoles is empty, no role check is needed
        if (!empty($allowedRoles)) {
            // Check if the user has one of the allowed roles
            $userRole = $_SESSION['user_role'];
            if (!in_array($userRole, $allowedRoles)) {
                // Redirect to a page indicating unauthorized access or display an error message
                header("Location: unauthorized.php");
                exit();
            }
        }
    }

    public function redirectToIndexIfLoggedIn() {
        // If the user is already logged in
        if ($this->userController->isLoggedIn()) {
            $userRole = $_SESSION['user_role'];
            if ($userRole === 'admin') {
                header("Location: admin.php");
                exit();
            } else {
                // If the user is not an admin, redirect to index.php
                header("Location: index.php");
                exit();
            }
        }
    }    
}
?>
