<?php
require_once('../controllers/AuthController.php');
require_once('../controllers/CoursesController.php');
require_once('../controllers/CourseReviewsController.php');
require_once('../controllers/UsersController.php');
require_once('../controllers/CourseProgressController.php');

$authController = new AuthController();
$coursesController = new CoursesController();
$courseReviewsController = new CourseReviewsController();
$usersController = new UsersController();
$courseProgressController = new CourseProgressController();

$allowedRoles = [];
$authController->checkAuthentication($allowedRoles);

if ($_SESSION['user_role'] == 'admin') {
    include("admin-header.php");
} else {
    include("student-header.php");
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header("Location: courses.php");
    exit;
}


$courseProgress = $courseProgressController->getUserCourseProgress($_SESSION['user_id'], $id);

if ($courseProgress->getStatus() == 'Not Started') {
    $courseProgress->setStatus('In Progress');
    $courseProgressController->updateCourseProgress($courseProgress);
}



$comments = $courseReviewsController->getAllCourseReviews();

$course = $coursesController->getCourse($id);
$rating = $courseReviewsController->getAverageRatingByCourseId($id);
$filledStars = str_repeat("★", round($rating));
$emptyStars = str_repeat("☆", 5 - round($rating));
$stars = $filledStars . $emptyStars;

echo("
<!-- Begin Page Content -->
<div class='container-fluid'>

    <!-- Page Heading -->
    <div class='d-sm-flex align-items-center justify-content-between mb-4'>
        <h1 class='h3 mb-0 text-gray-800'>Dashboard</h1>
    </div>

    <!-- Content Row -->
    <!-- Area Chart -->
    <!-- Approach -->
    <div class='card shadow mb-4'>
        <div class='card-header py-3'>
        <table><tr><td width='95%'>
            <h4 class='m-0 font-weight-bold text-primary'>" . $course['title'] . "</h4><p style='color:#f9d71c;font-size:30px;'>$stars</p></td>");
            if($_SESSION['user_role'] == 'admin') {
                echo("<td>
                        <a href='editCourse.php?id=".$course['id']."' class='btn btn-primary .bg-gradient-primary'>
                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-fill' viewBox='0 0 16 16'>
                        <path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10z'/>
                        </svg>
                        </a>
                    </td>
                    <td>
                        <a href='deleteCourse.php?id=".$course['id']."' class='btn btn-danger .bg-gradient-danger'>
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
       echo(" </div>
        <div class='card-body' >
            <p>" . $course['content'] . "</p>
            ");
            if($course['file_url'] !="")
            echo("<p>File link : <a href='" . $course['file_url'] . "'>Click here !</a></p>");
            echo("<form action='completed.php' method='POST'>
                <input type='hidden' name='id' value='$id'>
                <button class='btn btn-success btn-user btn-block' type='submit'>Completed</button>
            </form>
        </div>
    </div>
    <div class='card shadow mb-4'>
        <div class='card-header py-3'>
            <h6 class='m-0 font-weight-bold text-primary'>comments</h6>
        </div>");
        if($courseReviewsController->getUserCourseReview($_SESSION['user_id'],$id)){
        echo("<div class='card-body'>
            <form method='post' action='comment_action.php' onsubmit='return validateForm();'>
                <input type='hidden' value='" . $id . "' name='id'>
                <!-- Star rating system -->
                <div class='rating'>
                    <input onchange='validateForm()' type='radio' id='star5' name='rating' value='5' class='radio-btn hide' /><label for='star5' title='Rocks!'>★</label>
                    <input onchange='validateForm()' type='radio' id='star4' name='rating' value='4' class='radio-btn hide' /><label for='star4' title='Pretty good'>★</label>
                    <input onchange='validateForm()' type='radio' id='star3' name='rating' value='3' class='radio-btn hide' /><label for='star3' title='Meh'>★</label>
                    <input onchange='validateForm()' type='radio' id='star2' name='rating' value='2' class='radio-btn hide' /><label for='star2' title='Kinda bad'>★</label>
                    <input onchange='validateForm()' type='radio' id='star1' name='rating' value='1' class='radio-btn hide' /><label for='star1' title='Sucks big time'>★</label>
                </div>
                <div class='form-floating'>
                    <textarea class='form-control' name='comment' required placeholder='Leave a comment here' id='floatingTextarea2' style='height: 100px'></textarea>
                    <button id='submitBtn' class='btn btn-primary btn-user btn-block' type='submit' disabled>Add comment</button>
                </div>
            </form>
            <br>
            ");}
            foreach (array_reverse($comments) as $comment) {
                if($comment['course_id']==$id){
                    $user =  $usersController->getUser($comment['user_id']);
                    $stars = str_repeat('★', $comment['rating']);
                    $emptyStars = str_repeat('☆', 5 - $comment['rating']);
                    echo("
                                <div class='card mb-4 py-3 border-bottom-info' style='padding:5%;'>
                                <table><tr><td width='50px'><img class='img-profile rounded-circle' src='img/undraw_profile.svg' width='40px'></td> <td><h6 class='text-primary' style='margin-top:15px;'>" . $user->getFirstName()." ".$user->getLastName() . "</h6><p style='color:#f9d71c;'>".$stars.$emptyStars."</p></td></tr></table>
                                    <div class='card-body'>
                                        <p>" . $comment['review'] . "</p>"
                    );
                    if ($_SESSION['user_role'] == 'admin' || $_SESSION['user_id'] == $comment['user_id']) {
                        echo("
                            <form method='post' action='delete_comment.php' style='float: right;'>
                                <input type='hidden' name='comment_id' value='".$comment['id']."' />
                                <button type='submit' class='btn btn-danger'>Delete</button>
                            </form>
                        ");
                    }
                    echo("</div></div></div>");
                }
            }
            

echo("
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

");
include('footer.php');
echo("<style>
.hide {
    display: none;
}

.rating {
    unicode-bidi: bidi-override;
    direction: rtl;
    margin-left:10px;
}
.rating > label {
    display: inline-block;
    position: relative;
    width: 1.1em;
    font-size: 30px;
    color: #858796;
}
.rating > label:hover,
.rating > label:hover ~ label,
.rating > input.radio-btn:checked ~ label {
    color: #f9d71c;
    cursor: pointer;
}
.rating > input.radio-btn:not(:checked) ~ label.error {
    color: #f00;
}
</style>

<script>
function validateForm() {
    var radios = document.getElementsByName('rating');
    var formValid = Array.from(radios).some(radio => radio.checked);

    document.getElementById('submitBtn').disabled = !formValid;
}
</script>
");
?>
