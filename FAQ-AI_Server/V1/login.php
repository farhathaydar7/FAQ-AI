<?php
require_once '../universal.php';
require_once dirname(__FILE__) . '/config.php';
require_once api . 'models/User.model.php';
require_once api . 'skeletons/User.skeleton.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $user = UserSkeleton::findByUsername($username);

    if ($user) {
        if (hash('sha256', $password) === $user->getPassword()) {
            echo "Login successful!";
        } else {
            echo "Incorrect password.";
        }
    } else {
        echo "User not found.";
    }
}
?>