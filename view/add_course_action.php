<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require("../controllers/CoursesController.php");

    function getLoggedInUserId() {
        return $_SESSION['user_id'];
    }

    $title = $_POST["title"];
    $description = $_POST["description"];
    $content = $_POST["content"];
    $adminId = getLoggedInUserId(); 
    if(empty($title) || empty($description) || empty($content)) {
        header("Location: add_course.php?id=$courseId&error=Title, description or content cannot be empty");
        exit();
    }
    $course = new Course(null, $title, $description, $content, $adminId);

    $coursesController = new CoursesController();
    $result = $coursesController->insert($course);


    header("Location: admin.php");

}
?>