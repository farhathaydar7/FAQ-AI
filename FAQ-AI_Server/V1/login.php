<?php
require_once '../universal.php';
require_once dirname(__FILE__) . '/config.php';
require_once '../models/User.model.php';
require_once api . 'skeletons/User.skeleton.php';

// Read raw POST data
$data = json_decode(file_get_contents('php://input'), true);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get username and password from JSON
    $username = $data['username'];
    $password = $data['password'];

    $user = UserSkeleton::findByUsername($username);

    if ($user) {
        if (hash('sha256', $password) === $user->getPassword()) {
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