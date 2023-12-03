<?php
// Check Auth admin
require_once('../controllers/AuthController.php');
require_once('../controllers/CoursesController.php');
$authController = new AuthController();
$coursesController = new CoursesController();
$allowedRoles = ['admin'];
$authController->checkAuthentication($allowedRoles);

include("admin-header.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header("Location: courses.php");
    exit;
}

$course = $coursesController->getCourse($id);

echo("
                <script src='https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js' referrerpolicy='origin'></script>
                <script>
                tinymce.init({
                    selector: '#mytextarea'
                });
                </script>
                <!-- Begin Page Content -->
                <div class='container-fluid'>

                    <!-- Page Heading -->
                    <div class='d-sm-flex align-items-center justify-content-between mb-4'>
                        <h1 class='h3 mb-0 text-gray-800'>Courses</h1>
                    </div>
                        <!-- Area Chart -->
                            <!-- Approach -->
                            <div class='card shadow mb-4'>
                                <div class='card-header py-3'>
                                    <h6 class='m-0 font-weight-bold text-primary'>Edit</h6>
                                </div>
                                <div style='padding:10px;'>");
                                if (isset($_GET['error'])) {
                                    echo "<p class='border-bottom-danger'>" . $_GET['error'] . "</p>";
                                }
                                if (isset($_GET['message'])) {
                                    echo "<p class='border-bottom-success'>" . $_GET['message'] . "</p>";
                                }

echo("</div>
                                <div class='card-body'>
                                    <form method='POST' action='update_course_action.php'>
                                        <input type='hidden' name='course_id' value='");echo $course['id'];echo("'>
                                        <input type='text' class='form-control form-control-user' name='title' id='title' placeholder='Course Title' value='");echo $course['title'];echo("'><br>
                                        <input type='text' class='form-control form-control-user' name='description' id='description' placeholder='Course Description' value='");echo $course['description'];echo("'><br>
                                        <textarea id='mytextarea' name='content' rows='25'>");echo $course['content'];echo("</textarea>
                                        <br>
                                        <button class='btn btn-primary btn-user btn-block' type='submit'>
                                            Update
                                        </button>
                                    </form>
                                </div>
                            </div>
                    </div>
                </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            
            ");
include('footer.php');
