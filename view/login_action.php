<?php
session_start(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require("../controllers/UsersController.php");

    $email = $_POST["email"];
    $password = $_POST["password"];

    $userController = new UsersController();

    if ($userController->login($email, $password)) {
        $userRole = $_SESSION['user_role'];

        if ($userRole === 'admin') {
            header("Location: admin.php");
            exit();
        } else {
            header("Location: index.php");
            exit();
        }
    } else {
        header("Location: login.php?error=Invalid login credentials");
        exit();
    }
}
?>
