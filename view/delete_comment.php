<?php
session_start();

require_once('../controllers/CourseReviewsController.php');

if (isset($_SESSION['user_id']) && isset($_POST['comment_id'])) {
    $commentController = new CourseReviewsController();

    $comment = $commentController->getCourseReview($_POST['comment_id']);

    if ($_SESSION['user_role'] == 'admin' || $_SESSION['user_id'] == $comment['user_id']) {
        $commentController->delete($_POST['comment_id']);
    }
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;
?>
