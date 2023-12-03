<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require("../controllers/CoursesController.php");

    function getLoggedInUserId() {
        return $_SESSION['user_id'];
    }

    $courseId = $_POST["course_id"]; 
    $title = $_POST["title"];
    $description = $_POST["description"];
    $content = $_POST["content"];
    $adminId = getLoggedInUserId(); 

    // Check if title, description, and content are not empty
    if(empty($title) || empty($description) || empty($content)) {
        header("Location: editCourse.php?id=$courseId&error=Title, description or content cannot be empty");
        exit();
    }

    $course = new Course($courseId, $title, $description, $content, $adminId);

    $coursesController = new CoursesController();
    $coursesController->updateCourse($course); 

    header("Location: editCourse.php?id=$courseId&message=Course updated successfully");
    exit();
}
?>
