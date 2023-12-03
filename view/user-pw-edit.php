<?php
require_once('../controllers/AuthController.php');
require_once('../controllers/UsersController.php');

$authController = new AuthController();
$usersController = new UsersController();

$allowedRoles = [];
$authController->checkAuthentication($allowedRoles);

if ($_SESSION['user_role'] == 'admin') {
    include("admin-header.php");
} else {
    include("student-header.php");
}

if(isset($_SESSION['user_id'])){
    $id = $_SESSION['user_id'];
    $email = $_SESSION['user_email'];
    $first_name = $_SESSION['user_first_name'];
    $last_name = $_SESSION['user_last_name'];
}
?>
<div class='container-fluid'>
<div class='card shadow mb-4'>
    <div class='card-header py-3'>
        <h4 class='m-0 font-weight-bold text-primary'>Edit</h4>
    </div>

    <div class='card-body'>
        <form action="edit_pw_action.php" method="post">
            <label for="password0">Old Password:</label><br>
            <input class="form-control form-control-user" type="password" id="password0" name="password0"><br>
            <label for="password1">New Password:</label><br>
            <input class="form-control form-control-user" type="password" id="password1" name="password1"><br>
            <label for="password2">Confirm New Password:</label><br>
            <input class="form-control form-control-user" type="password" id="password2" name="password2"><br>
            <input class='btn btn-primary btn-user btn-block' type="submit" value="Submit">
        </form>
    </div>
</div>
</div>
<?php
include("footer.php");
?>
