<?php
include_once('../models/coursereviews.php');
include_once('../database/config.php');

class CourseReviewsController extends Connexion {
    function __construct() {
        parent::__construct();
    }

    function insert(CourseReview $courseReview) {
        $query = "INSERT INTO CourseReviews (user_id, course_id, review, rating) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($query);
        $params = array($courseReview->getUserId(), $courseReview->getCourseId(), $courseReview->getReview(), $courseReview->getRating());
        return $stmt->execute($params);
    }

    function getCourseReview($id) {
        $query = "SELECT * FROM CourseReviews WHERE id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array($id));
        $array = $stmt->fetch();
        return $array;
    }

    function delete($id) {
        $query = "DELETE FROM CourseReviews WHERE id = ?";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute(array($id));
    }

    function getAllCourseReviews() {
        $query = "SELECT * FROM CourseReviews";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function updateCourseReview(CourseReview $courseReview) {
        $query = "UPDATE CourseReviews SET user_id=?, course_id=?, review=?, rating=? WHERE id=?";
        $stmt = $this->pdo->prepare($query);
        $params = array($courseReview->getUserId(), $courseReview->getCourseId(), $courseReview->getReview(), $courseReview->getRating(), $courseReview->getId());
        $stmt->execute($params);
    }

    function getAverageRatingByCourseId($course_id) {
        $query = "SELECT AVG(rating) as average_rating FROM CourseReviews WHERE course_id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array($course_id));
        $result = $stmt->fetch();
        return $result['average_rating'];
    }
    
    
}
?>
