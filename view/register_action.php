<?php
session_start(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require("../models/users.php");
    require("../controllers/UsersController.php");

    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $password2 = $_POST["password2"];

    if (empty($first_name)) {
        header("Location: register.php?error=First name is required. ");
        exit();
    }

    if (empty($last_name)) {
        header("Location: register.php?error=Last name is required. ");
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: register.php?error=Invalid email address. ");
        exit();
    }

    if (empty($password)) {
        header("Location: register.php?error=Password is required. ");
        exit();
    }

    if ($password !== $password2) {
        header("Location: register.php?error=Passwords do not match. ");
        exit();
    }


    $userController = new UsersController();
    if ($userController->isEmailUnique($email)) {

        $user = new User(null, $first_name, $last_name, $email, $password, 'student');

        $result = $userController->insert($user);

        if ($result) {
            header("Location: login.php");
            exit();
        } else {
            header("Location: register.php?error=Registration failed. Please try again.");
        }
    } else {
        header("Location: register.php?error=Email address is already registered. Please use a different email.");
    }
}
?>
