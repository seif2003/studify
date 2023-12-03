<?php
include_once('../models/courseprogress.php');
include_once('../database/config.php');

class CourseProgressController extends Connexion {
    function __construct() {
        parent::__construct();
    }

    function insert(CourseProgress $courseProgress) {
        $query = "INSERT INTO CourseProgress (user_id, course_id, status) VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($query);
        $params = array($courseProgress->getUserId(), $courseProgress->getCourseId(), $courseProgress->getStatus());
        return $stmt->execute($params);
    }

    function getCourseProgress($id) {
        $query = "SELECT * FROM CourseProgress WHERE id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array($id));
        $array = $stmt->fetch();
        return $array;
    }

    function delete($id) {
        $query = "DELETE FROM CourseProgress WHERE id = ?";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute(array($id));
    }

    function getAllCourseProgress() {
        $query = "SELECT * FROM CourseProgress";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function updateCourseProgress(CourseProgress $courseProgress) {
        $query = "UPDATE CourseProgress SET user_id=?, course_id=?, status=? WHERE id=?";
        $stmt = $this->pdo->prepare($query);
        $params = array($courseProgress->getUserId(), $courseProgress->getCourseId(), $courseProgress->getStatus(), $courseProgress->getId());
        $stmt->execute($params);
    }
    function isEnrolled($userId, $courseId) {
        $query = "SELECT * FROM CourseProgress WHERE user_id = ? AND course_id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array($userId, $courseId));
        $array = $stmt->fetch();
        return !empty($array);
    }
    function countCoursesWithStatus($userId, $status) {
        $query = "SELECT COUNT(*) FROM CourseProgress WHERE user_id = ? AND status = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array($userId, $status));
        return $stmt->fetchColumn();
    }
    function getUserCourseProgress($userId, $courseId) {
        $query = "SELECT * FROM CourseProgress WHERE user_id = ? AND course_id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array($userId, $courseId));
        $array = $stmt->fetch();
    
        $courseProgress = new CourseProgress();
        $courseProgress->setId($array['id']);
        $courseProgress->setUserId($array['user_id']);
        $courseProgress->setCourseId($array['course_id']);
        $courseProgress->setStatus($array['status']);
    
        return $courseProgress;
    }

    function getUserProgress($id) {
        $query = "SELECT * FROM CourseProgress WHERE user_id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array($id));
        return $stmt;
    }
    
}

?>
