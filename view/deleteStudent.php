<?php
require("../controllers/UsersController.php");
require("../controllers/CourseReviewsController.php");
require("../controllers/CourseProgressController.php");
require_once('../controllers/AuthController.php');

$authController = new AuthController();
$allowedRoles = ['admin'];
$authController->checkAuthentication($allowedRoles);

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $studentId = $_GET["id"]; 

    $courseReviewsController = new CourseReviewsController();
    $courseProgressController = new CourseProgressController();

    // Get all course reviews by the student
    $reviews = $courseReviewsController->getAllCourseReviews();
    foreach ($reviews as $review) {
        if ($review['user_id'] == $studentId) {
            $courseReviewsController->delete($review['id']);
        }
    }

    // Get all course progress by the student
    $progresses = $courseProgressController->getAllCourseProgress();
    foreach ($progresses as $progress) {
        if ($progress['user_id'] == $studentId) {
            $courseProgressController->delete($progress['id']);
        }
    }

    $usersController = new UsersController();
    $usersController->delete($studentId); 

    // Since delete doesn't return a value, we'll assume it's successful if we reach this point
    header("Location: students.php");
    exit();
}
?>