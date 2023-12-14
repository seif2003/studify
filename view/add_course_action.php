<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require("../controllers/CoursesController.php");

    function getLoggedInUserId() {
        return $_SESSION['user_id'];
    }
    $targetFile='';
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
        echo("<h1>YES</h1>");
        $targetFile = "uploads/". basename($_FILES["file"]["name"]);
        move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile);
    }
    echo("file : ".$targetFile);
    $title = $_POST["title"];
    $description = $_POST["description"];
    $content = $_POST["content"];
    $adminId = getLoggedInUserId(); 
    if(empty($title) || empty($description) || empty($content)) {
        header("Location: add_course.php?id=$courseId&error=Title, description or content cannot be empty");
        exit();
    }
    echo($targetFile);
    $course = new Course(null, $title, $description, $content, $adminId,$targetFile);

    $coursesController = new CoursesController();
    $result = $coursesController->insert($course);


    header("Location: admin.php");

}
?>