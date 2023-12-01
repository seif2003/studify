<?php
session_start(); 

require("../controllers/UsersController.php");

$userController = new UsersController();
$userController->logout();

header("Location: login.php");
exit();
?>
