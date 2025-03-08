<?php
require_once '../universal.php';
require_once dirname(__FILE__) . '/config.php';
require_once api . 'models/User.model.php';
require_once api . 'skeletons/User.skeleton.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = $_POST["fullName"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    $user = new User(null, $fullName, $username, $password);

    $success = UserSkeleton::create($user);

    if ($success) {
        echo "Registration successful!";
    } else {
        echo "Registration failed.";
    }
}
?>

