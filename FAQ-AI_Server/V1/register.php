<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
require_once '../universal.php';
require_once dirname(__FILE__) . '/config.php';
require_once '../models/User.model.php';
require_once '../skeletons/User.skeleton.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $json = file_get_contents('php://input');

    if ($json === false) {
        echo json_encode(["error" => "Failed to read input"]);
        exit;
    }

    $data = json_decode($json, true);

    if (!$data) {
        echo json_encode(["error" => "Invalid JSON format"]);
        exit;
    }

    $fullName = isset($data['fullName']) ? trim($data['fullName']) : '';
    $username = isset($data['username']) ? trim($data['username']) : '';
    $password = isset($data['password']) ? trim($data['password']) : '';

    if (empty($fullName) || empty($username) || empty($password)) {
            echo json_encode([
                'status' => 'error',
                'message' => 'All fields are required.'
            ]);
        }
    
        // exit(); // Remove exit to see var_dump outputs
    
    if (strlen($username) < 5) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Username must be at least 5 characters long.'
        ]);
        exit();
    }

    $user = new User(null, $fullName, $username, $password);

    $success = UserSkeleton::create($user);

    if ($success) {
        echo json_encode([
            'status' => 'success',
            'message' => 'Registration successful!'
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Registration failed.'
        ]);
    }
}
?>
