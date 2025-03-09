<?php
require_once __DIR__ . '/../skeletons/Faq.skeleton.php';
require_once __DIR__ . '/../universal.php';

// Allow cross-origin requests
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

try {
    // Verify request method
    if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
        http_response_code(405); // Method Not Allowed
        echo json_encode(["message" => "Method not allowed"]);
        exit();
    }

    // Check if query parameter exists
    if (!isset($_GET['query'])) {
        http_response_code(400); // Bad Request
        echo json_encode(["message" => "Search query parameter 'query' is required"]);
        exit();
    }

    $query = trim($_GET['query']);
    
    // Validate query length
    if (strlen($query) < 2) {
        http_response_code(400);
        echo json_encode(["message" => "Search query must be at least 2 characters"]);
        exit();
    }

    // Perform search
    $faqs = FaqSkeleton::search($query);

    // Prepare response
    $response = [];
    foreach ($faqs as $faq) {
        $response[] = [
            'id' => $faq->getId(),
            'question' => $faq->getQuestion(),
            'answer' => $faq->getAnswer()
        ];
    }

    http_response_code(200);
    echo json_encode($response);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["message" => "Database error: " . $e->getMessage()]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["message" => "Server error: " . $e->getMessage()]);
}