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

    $course = new Course(null, $title, $description, $content, $adminId);

    $coursesController = new CoursesController();
    $result = $coursesController->insert($course);

    if ($result) {
        header("Location: admin.php");
        exit();
    } else {
        header("Location: add_course.php?error=Failed to add course");
        exit();
    }
}
?>