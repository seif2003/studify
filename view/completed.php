<?php
session_start();

require_once('../controllers/CourseProgressController.php');

if (isset($_SESSION['user_id'])) {
    $id = $_POST['id'];

    $courseProgressController = new CourseProgressController();

    $courseProgress = $courseProgressController->getUserCourseProgress($_SESSION['user_id'], $id);

    if ($courseProgressController->isEnrolled($_SESSION['user_id'], $id)) {
        $courseProgress->setStatus('completed');
        $courseProgressController->updateCourseProgress($courseProgress);
    }
}

header('Location: congratulation.php');
exit;
?>
