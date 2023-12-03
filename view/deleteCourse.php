<?php
require_once('../controllers/AuthController.php');

$authController = new AuthController();
$allowedRoles = ['admin'];
$authController->checkAuthentication($allowedRoles);

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    require("../controllers/CoursesController.php");

    $courseId = $_GET["id"]; 

    $coursesController = new CoursesController();
    $coursesController->delete($courseId); 

    header("Location: courses.php");
    exit();
}
?>
