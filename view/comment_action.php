<?php
session_start();
require_once('../controllers/CourseReviewsController.php');
require_once('../models/coursereviews.php');

$comment = $_POST['comment'];
$id = $_POST['id'];
$rating = $_POST['rating'];

$courseReview = new CourseReview();
$courseReview->setUserId($_SESSION['user_id']);
$courseReview->setCourseId($id);
$courseReview->setReview($comment);
$courseReview->setRating($rating);

$courseReviewsController = new CourseReviewsController();
$courseReviewsController->insert($courseReview);

header("Location: course.php?id=".$id);
exit;

?>
