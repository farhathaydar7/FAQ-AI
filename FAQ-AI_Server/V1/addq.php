<?php
require_once '../universal.php';
require_once dirname(__FILE__) . '/config.php';
require_once api . 'models/Faq.model.php';
require_once api . 'skeletons/Faq.skeleton.php';

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $question = $_POST["question"];
    $answer = $_POST["answer"];

    $faq = new Faq(null, $question, $answer);

    if (FaqSkeleton::create($faq)) {
        echo json_encode(["message" => "Question added successfully"]);
    } else {
        echo json_encode(["message" => "Failed to add question"]);
    }
} else {
    echo json_encode(["message" => "Invalid request method"]);
}
?>