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
    <div style='padding:10px;'>
    <?php
    if (isset($_GET['error'])) {
        echo "<p class='border-bottom-danger'>" . $_GET['error'] . "</p>";
    }
    if (isset($_GET['message'])) {
        echo "<p class='border-bottom-success'>" . $_GET['message'] . "</p>";
    }
    ?>
    </div>
    <div class='card-body'>
        <form action="edit_action.php" method="post">
            <label for="first_name">First Name:</label><br>
            <input class="form-control form-control-user" type="text" id="first_name" name="first_name" value="<?php echo $first_name; ?>"><br>
            <label for="last_name">Last Name:</label><br>
            <input class="form-control form-control-user" type="text" id="last_name" name="last_name" value="<?php echo $last_name; ?>"><br>
            <label for="email">Email:</label><br>
            <input class="form-control form-control-user" type="email" id="email" name="email" value="<?php echo $email; ?>"><br>
            <a href="user-pw-edit.php">Edit password</a><br><br>
            <input type="submit" value="Submit" class='btn btn-primary btn-user btn-block'>
        </form>
    </div>
</div>
</div>
<?php
include("footer.php");
?>
