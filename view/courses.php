<?php
require_once('../controllers/AuthController.php');
require_once('../controllers/CoursesController.php');
require_once('../controllers/CourseProgressController.php');
require_once('../controllers/CourseReviewsController.php');

$courseReviewsController = new CourseReviewsController();
$authController = new AuthController();

$allowedRoles = [];
$authController->checkAuthentication($allowedRoles);

if($_SESSION['user_role'] == 'admin')
    include("admin-header.php");
else
    include("student-header.php");

$coursesController = new CoursesController();
$courseProgressController = new CourseProgressController();
$course = $coursesController->getAllCourses();

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
                            <th>Description</th>
                            <th>Rating</th>
                            <th width='100px'>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>title</th>
                            <th>Description</th>
                            <th>Rating</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    <?php
                        foreach (array_reverse($course) as $c) {
                            if(!$courseProgressController->isEnrolled($_SESSION['user_id'],$c['id'])){
                                $rating = $courseReviewsController->getAverageRatingByCourseId($c['id']);
                                $filledStars = str_repeat("★", round($rating));
                                $emptyStars = str_repeat("☆", 5 - round($rating));
                                $stars = $filledStars . $emptyStars;

                                echo("<tr>
                                    <td>".$c['id']."</td>
                                    <td>".$c['title']."</td>
                                    <td>".$c['description']."</td>
                                    <td style='color:#f9d71c;'>".$stars."</td>
                                    <td>
                                    <table>
                                    <tr><td>
                                        <form action='enrollCourse.php' method='post' >
                                            <input type='hidden' name='courseId' value='".$c['id']."'>
                                            <button type='submit' class='btn btn-success .bg-gradient-success'>
                                            <svg width='16' height='16' fill='currentColor' class='bi bi-bag-fill' viewBox='0 0 16 16'>
                                            <path d='M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4z'/>
                                        </svg>
                                            </button></form></td>");
                                if($_SESSION['user_role'] == 'admin') {
                                    echo("<td>
                                            <a href='editCourse.php?id=".$c['id']."' class='btn btn-primary .bg-gradient-primary'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-fill' viewBox='0 0 16 16'>
                                            <path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10z'/>
                                            </svg>
                                            </a>
                                        </td>
                                        <td>
                                            <a href='deleteCourse.php?id=".$c['id']."' class='btn btn-danger .bg-gradient-danger'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash3-fill' viewBox='0 0 16 16'>
                                            <path d='M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5'/>
                                            </svg>
                                            </a>
                                        </td>
                                        </tr></table>
                                    ");
                                }
                                else{
                                    echo("</tr></table>");
                                }
                                echo("
                                    </td>
                                </tr>");
                            }
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