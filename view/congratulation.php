<?php
require_once('../controllers/AuthController.php');

$authController = new AuthController();

$allowedRoles = [];
$authController->checkAuthentication($allowedRoles);

if ($_SESSION['user_role'] == 'admin') {
    include("admin-header.php");
} else {
    include("student-header.php");
}?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Congratulations</h6>
        </div>
        <div class="card-body">
            <center>
                <h1>Congratulations !</h1><br>
                <p>Congratulations on successfully completing your course! 🎉 This is a significant achievement and a testament to your hard work, dedication, and discipline. You’ve gained new knowledge and skills that will serve you well in your future endeavors. Remember, learning is a lifelong journey, and this is just one milestone on your path. Keep up the great work, and continue to strive for excellence. Well done! 👏</p>
                <img src='img/congratulation.png'><br>
                <a href="courses.php" class="btn btn-success btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-arrow-right"></i>
                    </span>
                    <span class="text">Discover more courses</span>
                </a>
            </center>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
<?php
include('footer.php');
?>