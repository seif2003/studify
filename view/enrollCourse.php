<?php
session_start();

require_once('../controllers/CourseProgressController.php');
require_once('../models/CourseProgress.php');

$userId = $_SESSION['user_id'];
$courseId = $_POST['courseId'];

$courseProgress = new CourseProgress(null, $userId, $courseId, 'Not Started');
$courseProgressController = new CourseProgressController();

if ($courseProgressController->insert($courseProgress)) {
    header("Location: courses.php");
} 
?>
