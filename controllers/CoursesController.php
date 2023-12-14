<?php
include_once('../models/courses.php');
include_once('../database/config.php');

class CoursesController extends Connexion {
    function __construct() {
        parent::__construct();
    }

    function insert(Course $course) {
        $query = "INSERT INTO Courses (title, description, content, admin_id,file_url) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($query);
        $params = array($course->getTitle(), $course->getDescription(), $course->getContent(), $course->getAdminId(),$course->getFile_url());
        return $stmt->execute($params);
    }

    function getCourse($id) {
        $query = "SELECT * FROM Courses WHERE id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array($id));
        $array = $stmt->fetch();
        return $array;
    }

    function delete($id) {
        $query = "DELETE FROM Courses WHERE id = ?";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute(array($id));
    }

    function getAllCourses() {
        $query = "SELECT * FROM Courses";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function updateCourse(Course $course) {
        $query = "UPDATE Courses SET title=?, description=?, content=?, admin_id=? WHERE id=?";
        $stmt = $this->pdo->prepare($query);
        $params = array($course->getTitle(), $course->getDescription(), $course->getContent(), $course->getAdminId(), $course->getId());
        $stmt->execute($params);
    }
}
?>
