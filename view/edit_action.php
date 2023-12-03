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

    // Check if first name, last name, and email are not empty
    if (!empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['email'])) {
        $user->setFirstName($_POST['first_name']);
        $user->setLastName($_POST['last_name']);
        $user->setEmail($_POST['email']);
        $updateStatus = $usersController->updateUser($user);

        // Update session variables
        $_SESSION['user_id'] = $user->getId();
        $_SESSION['user_email'] = $user->getEmail();
        $_SESSION['user_role'] = $user->getRole();
        $_SESSION['user_first_name'] = $user->getFirstName();
        $_SESSION['user_last_name'] = $user->getLastName();

        // Redirect with status message
        header('Location: user-edit.php?message=success');

    } else {
        // Redirect with error message if first name, last name, or email is empty
        header('Location: user-edit.php?error=empty%20fields');
    }
}
?>
