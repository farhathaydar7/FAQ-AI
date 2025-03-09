<?php
require_once '../universal.php';
require_once dirname(__FILE__) . '/config.php';
require_once '../models/Faq.model.php';
require_once '../skeletons/Faq.skeleton.php';

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $question = $_POST["question"];
    $answer = $_POST["answer"];

    $faq = new FaqModel();
    $faq->setQuestion($question);
    $faq->setAnswer($answer);

    if (FaqSkeleton::create($faq)) {
        echo json_encode(["message" => "Question added successfully"]);
    } else {
        echo json_encode(["message" => "Failed to add question"]);
    }
} else {
    echo json_encode(["message" => "Invalid request method"]);
}
?>