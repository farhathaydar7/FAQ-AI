<?php
require_once '../universal.php';
require_once dirname(__FILE__) . '/config.php';
require_once api . 'models/Faq.model.php';
require_once api . 'skeletons/Faq.skeleton.php';

header('Content-Type: application/json');

$faqs = FaqSkeleton::getAll();

$faqArray = [];
foreach ($faqs as $faq) {
    $faqArray[] = [
        'id' => $faq->getId(),
        'question' => $faq->getQuestion(),
        'answer' => $faq->getAnswer()
    ];
}

echo json_encode($faqArray);
?>