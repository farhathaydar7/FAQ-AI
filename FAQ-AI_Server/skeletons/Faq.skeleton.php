<?php
require_once __DIR__ . '/../models/Faq.model.php';
require_once __DIR__ . '/../V1/config.php';

class FaqSkeleton {
    private function __construct() {}

    private static function getDB() {
        return new PDO(DB_DSN, DB_USER, DB_PASS);
    }

    public static function create($faqModel) {
        $db = self::getDB();
        $stmt = $db->prepare("INSERT INTO faqs (question, answer) VALUES (?, ?)");
        $success = $stmt->execute([
            $faqModel->getQuestion(),
            $faqModel->getAnswer()
        ]);

        if($success) $faqModel->setId($db->lastInsertId());
        return $success;
    }

    public static function update($faqModel) {
        $db = self::getDB();
        $stmt = $db->prepare("UPDATE faqs SET question = ?, answer = ? WHERE id = ?");
        return $stmt->execute([
            $faqModel->getQuestion(),
            $faqModel->getAnswer(),
            $faqModel->getId()
        ]);
    }

    public static function delete($id) {
        $db = self::getDB();
        $stmt = $db->prepare("DELETE FROM faqs WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public static function findById($id) {
        $db = self::getDB();
        $stmt = $db->prepare("SELECT * FROM faqs WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row) {
            $faq = new FaqModel();
            $faq->setId($row['id']);
            $faq->setQuestion($row['question']);
            $faq->setAnswer($row['answer']);
            return $faq;
        }
        return null;
    }

    public static function getAll() {
        $db = self::getDB();
        $stmt = $db->query("SELECT * FROM faqs");
        $faqRows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $faqs = [];
        foreach ($faqRows as $row) {
            $faq = new FaqModel();
            $faq->setId($row['id']);
            $faq->setQuestion($row['question']);
            $faq->setAnswer($row['answer']);
            $faqs[] = $faq;
        }
        return $faqs;
    }

    public static function search($query) {
        $db = self::getDB();
        $stmt = $db->prepare("SELECT * FROM faqs WHERE question LIKE ? OR answer LIKE ?");
        $searchTerm = "%" . $query . "%";
        $stmt->execute([$searchTerm, $searchTerm]);
        $faqRows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $faqs = [];
        foreach ($faqRows as $row) {
            $faq = new FaqModel();
            $faq->setId($row['id']);
            $faq->setQuestion($row['question']);
            $faq->setAnswer($row['answer']);
            $faqs[] = $faq;
        }
        error_log("SQL Query: " . $stmt->queryString);
        error_log("Search Term: " . $searchTerm);
        error_log("FAQ IDs: " . json_encode(array_column($faqs, 'id'))); // Log IDs for brevity
        return $faqs;
    }


}
