<?php
require_once('../controllers/AuthController.php');
require_once('../controllers/UsersController.php');

$authController = new AuthController();
$usersController = new UsersController();

$allowedRoles = [];
$authController->checkAuthentication($allowedRoles);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_SESSION['user_id'];
    $user = $usersController->getUser($id);

    // Check if old password, new password, and confirm new password are not empty
    if (!empty($_POST['password0']) && !empty($_POST['password1']) && !empty($_POST['password2'])) {
        if ($_POST['password1'] === $_POST['password2']) {
            $user->setPassword($_POST['password1']);
            $updateStatus = $usersController->updateUser($user);

            // Redirect with status message
            header('Location: user-edit.php?message=password%20success');
        } else {
            // Redirect with error message if new password and confirm new password do not match
            header('Location: user-edit.php?error=password%20mismatch');
        }
    } else {
        // Redirect with error message if old password, new password, or confirm new password is empty
        header('Location: user-edit.php?error=empty%20password%20fields');
    }
}
?>
