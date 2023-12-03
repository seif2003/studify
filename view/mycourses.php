<?php
require_once('../controllers/AuthController.php');
require_once('../controllers/CourseProgressController.php');

$authController = new AuthController();
$allowedRoles = [];
$authController->checkAuthentication($allowedRoles);

if($_SESSION['user_role'] == 'admin')
    include("admin-header.php");
else
    include("student-header.php");


    
$userId = $_SESSION['user_id'];
    
$courseProgressController = new CourseProgressController();
    
$courseprogressarray = $courseProgressController->getUserProgress($userId);


?>


<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">All Courses</h1>
    <p class="mb-4">Here you will find all the courses of our program .</p>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Courses</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>title</th>
                            <th>Show</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>title</th>
                            <th>Show</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    <?php
                        foreach ($courseprogressarray as $courseprogress) {
                            $course = $coursesController->getCourse($courseprogress['course_id']);
                            echo("<tr>
                                <td>".$courseprogress['course_id']."</td></a>
                                <td>".$course['title']."</td>
                                <td>
                                    <a class='btn btn-primary' href='course.php?id=".$courseprogress['course_id']."'>
                                    <svg width='16' height='16' fill='currentColor' class='bi bi-eye-fill' viewBox='0 0 16 16'>
                                        <path d='M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0'/>
                                        <path d='M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7'/>
                                    </svg>
                                    </a>
                                </td>
                            </tr>");
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<?php
include("footer.php");
?>