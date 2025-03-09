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
            $secretKey  = SECRET_KEY; //secret key 
            $payload = [
                'user_id' => $user->getId(),
                'username' => $user->getUsername(),
                'exp' => time() + 3600  // Token expiration time (1 hour)
            ];

            echo json_encode([
                'status' => 'success',
                'message' => 'Login successful!'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Incorrect password.'
            ]);
        }
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'User not found.'
        ]);
    }
}
?>