<?php
include_once('../models/users.php');
include_once('../database/config.php');

class UsersController extends Connexion {
    function __construct() {
        parent::__construct();
    }

    function insert(User $user) {
        $query = "INSERT INTO Users (first_name, last_name, email, password, role) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($query);
        $params = array($user->getFirstName(), $user->getLastName(), $user->getEmail(), $user->getPassword(), $user->getRole());
        return $stmt->execute($params);
    }

    function getUser($id) {
        $query = "SELECT * FROM Users WHERE id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array($id));
        $array = $stmt->fetch();
        return $array;
    }

    function delete($id) {
        $query = "DELETE FROM Users WHERE id = ?";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute(array($id));
    }

    function getAllUsers() {
        $query = "SELECT * FROM Users";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function updateUser(User $user) {
        $query = "UPDATE Users SET email=?, password=?, role=? WHERE id=?";
        $stmt = $this->pdo->prepare($query);
        $params = array($user->getEmail(), $user->getPassword(), $user->getRole(), $user->getId());
        $stmt->execute($params);
    }

    public function isEmailUnique($email) {
        $query = "SELECT COUNT(*) FROM Users WHERE email = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$email]);

        $count = $stmt->fetchColumn();

        return $count === 0;
    }

    function login($email, $password) {
        $query = "SELECT * FROM Users WHERE email = ? AND password = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array($email, $password));
        $user = $stmt->fetch();
    
        if ($user) {
            session_start();
    
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_role'] = $user['role'];
            $_SESSION['user_first_name'] = $user['first_name'];
            $_SESSION['user_last_name'] = $user['last_name'];
    
            return true; 
        } else {
            return false; 
        }
    }
    

    public function isLoggedIn() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        return isset($_SESSION['user_id']);
    }

    function logout() {
        session_start();
        session_destroy();
    }

    function isAdminAuthenticated() {
        session_start();

        if (!$this->isLoggedIn()) {
            return false;
        }

        if ($_SESSION['user_role'] !== 'admin') {
            return false;
        }

        return true;
    }
}
?>
